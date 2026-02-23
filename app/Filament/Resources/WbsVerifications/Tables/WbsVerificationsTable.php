<?php

namespace App\Filament\Resources\WbsVerifications\Tables;

use App\Models\Tmwbls;
use App\Models\Verification;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\Textarea;
use Filament\Facades\Filament;
use App\Filament\Resources\WbsVerifications\WbsVerificationResource;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WbsVerificationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('i_wbls')
                    ->label('Nomor WBS')
                    ->searchable(),
                
                TextColumn::make('d_wbls')
                    ->label('Tanggal Pengaduan')
                    ->dateTime('d M Y'),

                TextColumn::make('kategori.n_wbls_categ')
                    ->label('Perihal')
                    ->searchable(),
                
                TextColumn::make('e_wbls_stat')
                    ->label('Keterangan'),
            ])

            ->recordActions([
                ViewAction::make(),
                EditAction::make()
                    ->label('Ubah'),

                Action::make('approve')
                    ->label('Setujui')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => is_null($record->f_wbls_agree))
                    ->requiresConfirmation()
                    ->action(function (Tmwbls $record) {

                        $exists = \App\Models\Verification::where('i_wbls', $record->i_wbls)
                            ->whereNotNull('f_wbls_usrname')
                            ->whereNotNull('f_wbls_file')
                            ->exists();

                        if (
                            ! $exists ||
                            trim((string) $record->e_wbls_stat) === ''
                        ) {
                            Notification::make()
                                ->title('Isi data verifikasi terlebih dahulu sebelum menyetujui.')
                                ->danger()
                                ->send();

                            return;
                        }

                        self::approve($record);

                        Notification::make()
                            ->title('Data berhasil disetujui.')
                            ->success()
                            ->send();
                    }),

                Action::make('generateBA')
                    ->label('Generate BA Verifikasi')
                    ->icon('heroicon-o-document-text')
                    ->color('success')
                    ->visible(fn (Tmwbls $record) => $record->f_wbls_agree === '1')
                    ->url(function (Tmwbls $record) {

                        $verification = Verification::firstOrCreate(
                            ['i_wbls' => $record->i_wbls],
                            [
                                'i_wbls_adm' => Auth::user()->i_wbls_adm,
                                'd_wbls_vrf' => now(),
                            ]
                        );

                        return route('ba.verifikasi.pdf', $verification->id);
                    })
                    ->openUrlInNewTab(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    protected static function approve(Tmwbls $record): void
    {
        $user = Filament::auth()->user();
        $cStat = '4';

        $record->update([
            'f_wbls_agree'   => '1',
            'c_wbls_stat'    => $cStat,
            'e_wbls_stat'    => null,
            'i_wbls_adm'     => $user->i_wbls_adm,
            'd_wbls_check'   => now(),
            'd_wbls_statupd' => now(),
        ]);
    }
}