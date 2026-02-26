<?php

namespace App\Filament\Resources\WbsVerifications\Tables;

use App\Models\Tmwbls;
use App\Models\TmwblsVrf;
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
                    ->label('Ubah')
                    ->mutateRecordDataUsing(function (array $data, Tmwbls $record): array {
                        $verificationData = [
                            'f_wbls_usrname' => $data['f_wbls_usrname'] ?? null,
                            'f_wbls_file' => $data['f_wbls_file'] ?? null,
                        ];

                        $verification = TmwblsVrf::where('i_wbls', $record->i_wbls)->first();

                        if (! $verification) {
                            $seq = (TmwblsVrf::max('i_wbls_bavrfseq') ?? 0) + 1;

                            $kode = 'BAV/' .
                                str_pad($seq, 4, '0', STR_PAD_LEFT) .
                                '/PTD/' .
                                now()->format('m/Y');

                            $verificationData = array_merge($verificationData, [
                                'i_wbls' => $record->i_wbls,
                                'i_wbls_bavrfseq' => $seq,
                                'i_wbls_bavrf' => $kode,
                                'i_wbls_adm' => Auth::user()->i_wbls_adm,
                                'd_wbls_vrf' => now(),
                            ]);
                        }

                        TmwblsVrf::updateOrCreate(
                            ['i_wbls' => $record->i_wbls],
                            $verificationData,
                        );

                        unset($data['f_wbls_usrname'], $data['f_wbls_file']);

                        return $data;
                    }),

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
