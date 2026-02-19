<?php

namespace App\Filament\Resources\WbsVerifications\Tables;

use App\Models\Tmwbls;
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
                EditAction::make(),

                Action::make('approve')
                    ->label('Setujui')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => is_null($record->f_wbls_agree))
                    ->requiresConfirmation()
                    ->action(fn (Tmwbls $record) => self::approve($record)),
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
}
