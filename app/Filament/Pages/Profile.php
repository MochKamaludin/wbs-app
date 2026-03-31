<?php

namespace App\Filament\Pages;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Spatie\Activitylog\Models\Activity;

class Profile extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $slug = 'profil-edit';

    protected static bool $shouldRegisterNavigation = false;
    
    public function getTitle(): string
    {
        return 'Edit Profil';
    }

    public function getHeading(): string
    {
        return 'Edit Profil';
    }
    
    public ?array $data = [];

    public function getView(): string
    {
        return 'filament.pages.auth.profile';
    }

    public function mount(): void
    {
        $firstLogin = $this->getFirstLoginActivity();
        $lastLogin = $this->getLastLoginActivity();
        $user = Auth::user();
        $this->form->fill([
            'n_wbls_adm' => $user->n_wbls_adm,
            'i_wbls_adm' => $user->i_wbls_adm,
            'i_emp' => $user->i_emp,
            'c_wbls_admauth' => $user->c_wbls_admauth,
            'd_entry' => ($user->d_entry && method_exists($user->d_entry, 'isoFormat'))
                ? $user->d_entry->isoFormat('dddd, D MMMM YYYY, HH:mm')
                : (\Carbon\Carbon::hasFormat($user->d_entry ?? '', 'Y-m-d H:i:s')
                    ? \Carbon\Carbon::parse($user->d_entry)->isoFormat('dddd, D MMMM YYYY, HH:mm')
                    : ($user->d_entry ?? '-')),

            'first_access' => $firstLogin && isset($firstLogin->created_at) && method_exists($firstLogin->created_at, 'isoFormat')
                ? $firstLogin->created_at->isoFormat('dddd, D MMMM YYYY, HH:mm') . ' (' . $firstLogin->created_at->diffForHumans() . ')'
                : 'Belum ada data',
            'last_access' => $lastLogin && isset($lastLogin->created_at) && method_exists($lastLogin->created_at, 'isoFormat')
                ? $lastLogin->created_at->isoFormat('dddd, D MMMM YYYY, HH:mm') . ' (' . $lastLogin->created_at->diffForHumans() . ')'
                : 'Ini adalah sesi pertama Anda',

            'recent_activities' => $this->formatRecentActivities(),
        ]);
    }

    protected function getFirstLoginActivity()
    {
        return Activity::where('causer_type', 'App\Models\User')
            ->where('causer_id', Auth::user()->i_wbls_adm)
            ->where('event', 'login')
            ->orderBy('created_at', 'asc')
            ->first();
    }

    protected function getLastLoginActivity()
    {
        $previousLogin = Activity::where('causer_type', 'App\Models\User')
            ->where('causer_id', Auth::user()->i_wbls_adm)
            ->where('event', 'login')
            ->orderBy('created_at', 'desc')
            ->skip(1) 
            ->first();
        
        return $previousLogin;
    }

    protected function formatRecentActivities(): string
    {
        $activities = Activity::where('causer_type', 'App\Models\User')
            ->where('causer_id', Auth::user()->i_wbls_adm)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        if ($activities->isEmpty()) {
            return 'Belum ada aktivitas yang tercatat';
        }

        $formatted = [];
        foreach ($activities as $activity) {
            $eventLabel = match($activity->event) {
                'login' => '🟢 Login',
                'logout' => '⚫ Logout',
                'created' => '🔵 Created',
                'updated' => '🟡 Updated',
                'deleted' => '🔴 Deleted',
                default => '⚪ ' . $activity->event,
            };
            
            $subject = $activity->subject_type && $activity->subject_id 
                ? ' - ' . class_basename($activity->subject_type) . ' #' . $activity->subject_id
                : '';
            
            $date = $activity->created_at->isoFormat('D MMM YYYY, HH:mm');
            $ip = $activity->properties->get('ip_address') 
                ? ' | IP: ' . $activity->properties->get('ip_address')
                : '';
            
            $formatted[] = "{$eventLabel}: {$activity->description}{$subject}\n{$date}{$ip}";
        }

        return implode("\n\n", $formatted);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Informasi Akun')
                    ->inlineLabel()
                    ->schema([
                        TextInput::make('n_wbls_adm')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(100),

                        TextInput::make('i_wbls_adm')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(100)
                            ->disabled()
                            ->dehydrated(false),

                        TextInput::make('i_emp')
                            ->label('NIK/NIP')
                            ->maxLength(50)
                            ->disabled(),

                        TextInput::make('c_wbls_admauth')
                            ->label('Otoritas')
                            ->disabled()
                            ->dehydrated(false)
                            ->formatStateUsing(fn ($state) => match($state) {
                                '0' => 'Administrator',
                                '1' => 'Verifikator',
                                '2' => 'Investigator',
                                default => 'Tidak Diketahui',
                            }),

                        TextInput::make('d_entry')
                            ->label('Akun Dibuat')
                            ->disabled()
                            ->dehydrated(false),
                    ])
                    ->columns(1)
                    ->footerActions([
                        Action::make('saveProfile')
                            ->label('Simpan Informasi Akun')
                            ->action('saveProfile')
                            ->color('primary'),
                    ]),

                Section::make('Ubah Kata Sandi')
                    ->schema([
                        TextInput::make('current_password')
                            ->label('Kata Sandi Saat Ini')
                            ->password()
                            ->revealable()
                            ->dehydrated(false)
                            ->validationAttribute('kata sandi saat ini'),

                        TextInput::make('c_wbls_admpswd')
                            ->label('Kata Sandi Baru')
                            ->password()
                            ->revealable()
                            ->rules([
                                Password::min(8)
                                    ->letters()
                                    ->mixedCase()
                                    ->numbers()
                                    ->symbols(),
                            ])
                            ->helperText(
                                'Minimal 8 karakter, mengandung huruf besar, huruf kecil, angka, dan simbol.'
                            )
                            ->dehydrated(fn ($state) => filled($state))
                            ->validationAttribute('kata sandi baru'),

                        TextInput::make('c_wbls_admpswd_confirmation')
                            ->label('Konfirmasi Kata Sandi Baru')
                            ->password()
                            ->revealable()
                            ->same('c_wbls_admpswd')
                            ->dehydrated(false)
                            ->validationAttribute('konfirmasi kata sandi baru'),
                    ])
                    ->columns(1)
                    ->footerActions([
                        Action::make('savePassword')
                            ->label('Simpan Kata Sandi')
                            ->action('savePassword')
                            ->color('primary'),
                    ]),

                Section::make('Login Activity')
                    ->schema([
                        TextInput::make('first_access')
                            ->label('Akses Pertama ke Situs')
                            ->disabled()
                            ->dehydrated(false),

                        TextInput::make('last_access')
                            ->label('Akses Terakhir ke Situs')
                            ->disabled()
                            ->dehydrated(false),
                    ])
                    ->columns(1),
                
                Section::make('Aktivitas Terakhir')
                    ->schema([
                        Textarea::make('recent_activities')
                            ->label('10 Aktivitas Terakhir')
                            ->disabled()
                            ->dehydrated(false)
                            ->rows(15)
                            ->columns(1),
                    ])
                    ->columns(1),
                
            ])
            ->columns(2)
            ->statePath('data');
    }

    public function saveProfile(): void
    {
        try {
            $data = $this->form->getState();
            $user = \App\Models\User::find(Auth::id());
            $user->fill([
                'n_wbls_adm' => $data['n_wbls_adm'],
            ]);
            $user->save();
            Notification::make()
                ->success()
                ->title('Informasi akun berhasil diperbarui')
                ->send();
        } catch (Halt $exception) {
            return;
        }
    }

    public function savePassword(): void
    {
        try {
            $formData = $this->form->validate()['data'] ?? [];
            $user = \App\Models\User::find(Auth::id());
            if (empty($formData['current_password'])) {
                Notification::make()
                    ->danger()
                    ->title('Kata sandi saat ini wajib diisi')
                    ->send();
                return;
            }
            if (!Hash::check($formData['current_password'], $user->c_wbls_admpswd)) {
                Notification::make()
                    ->danger()
                    ->title('Kata sandi saat ini tidak sesuai')
                    ->send();
                return;
            }
            $user->fill([
                'c_wbls_admpswd' => Hash::make($formData['c_wbls_admpswd']),
            ]);
            $user->save();
            $this->form->fill([
                'current_password' => null,
                'c_wbls_admpswd' => null,
                'c_wbls_admpswd_confirmation' => null,
            ]);
            Notification::make()
                ->success()
                ->title('Kata sandi berhasil diperbarui')
                ->body('Silakan gunakan kata sandi baru saat login berikutnya.')
                ->send();
        } catch (Halt $exception) {
            return;
        }
    }


    public function save(): void
    {
        try {
            $data = $this->form->getState();
            if (filled($data['current_password'] ?? null)) {
                if (!Hash::check($data['current_password'], Auth::user()->c_wbls_admpswd)) {
                    Notification::make()
                        ->danger()
                        ->title('Kata sandi saat ini tidak sesuai')
                        ->send();
                    return;
                }
            }
            $user = \App\Models\User::find(Auth::id());
            $user->fill([
                'n_wbls_adm' => $data['n_wbls_adm'],
                'i_emp' => $data['i_emp'] ?? null,
                'c_wbls_admpswd' => filled($data['c_wbls_admpswd'] ?? null) ? $data['c_wbls_admpswd'] : $user->c_wbls_admpswd,
            ]);
            $user->save();
            Notification::make()
                ->success()
                ->title('Profil berhasil diperbarui')
                ->send();
        } catch (Halt $exception) {
            return;
        }
    }

}