<?php

namespace App\Filament\Resources\WbsVerifications\Tables;

use App\Models\Tmwbls;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\Textarea;
use Filament\Facades\Filament;
use App\Filament\Resources\WbsVerifications\WbsVerificationResource;
use Filament\Actions\ViewAction;
use Illuminate\Support\Facades\DB;

class WbsVerificationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('i_wbls')
                    ->label('Nomor WBS')
                    ->searchable(),

                TextColumn::make('kategori.n_wbls_categ')
                    ->label('Kategori'),

                TextColumn::make('d_wbls')
                    ->label('Tanggal Lapor')
                    ->dateTime('d/m/Y H:i'),

                TextColumn::make('f_wbls_agree')
                    ->label('Status')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        null => 'warning',
                        '1'  => 'success',
                        '0'  => 'danger',
                    })
                    ->formatStateUsing(fn ($state) => match ($state) {
                        null => 'Menunggu Verifikasi',
                        '1'  => 'Disetujui',
                        '0'  => 'Ditolak',
                    }),
            ])

            ->recordActions([
                ViewAction::make(),
        

                Action::make('approve')
                    ->label('Setujui')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => is_null($record->f_wbls_agree))
                    ->requiresConfirmation()
                    ->action(fn (Tmwbls $record) => self::approve($record)),

                // Action::make('reject')
                //     ->label('Tolak')
                //     ->icon('heroicon-o-x-circle')
                //     ->color('danger')
                //     ->visible(fn ($record) => is_null($record->f_wbls_agree))
                //     ->requiresConfirmation()
                //     ->action(fn (Tmwbls $record, array $data) =>
                //         self::reject($record, $data)
                //     ),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    protected static function getStatusName(string $c_wbls_stat): ?string
    {
        return DB::table('trwblsstat')
            ->where('c_wbls_stat', $c_wbls_stat)
            ->value('e_wbls_stat');
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

    // protected static function reject(Tmwbls $record, array $data): void
    // {
    //     $cStat = '3';

    //     $record->update([
    //         'f_wbls_agree'   => '0',
    //         'c_wbls_stat'    => $cStat,
    //         'e_wbls_stat'    => self::getStatusName($cStat),
    //         'd_wbls_statupd' => now(),
    //     ]);
    // }
}
