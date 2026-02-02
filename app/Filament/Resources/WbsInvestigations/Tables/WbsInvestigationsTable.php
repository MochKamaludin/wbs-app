<?php

namespace App\Filament\Resources\WbsInvestigations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use App\Models\Tmwbls;

class WbsInvestigationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->query(fn () => Tmwbls::query()->where('f_wbls_agree', '1'))
            ->columns([
                TextColumn::make('i_wbls')
                    ->label('Nomor WBS')
                    ->searchable(),

                TextColumn::make('kategori.n_wbls_categ')
                    ->label('Kategori'),

                TextColumn::make('d_wbls')
                    ->label('Tanggal Lapor')
                    ->dateTime('d/m/Y H:i'),

                TextColumn::make('status.n_wbls_stat')
                    ->label('Status')
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
