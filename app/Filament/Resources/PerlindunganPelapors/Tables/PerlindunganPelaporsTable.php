<?php

namespace App\Filament\Resources\PerlindunganPelapors\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PerlindunganPelaporsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('n_wbls_protect')
                    ->label('Judul')
                    ->searchable(),

                TextColumn::make('f_wbls_protectstat')
                    ->label('Status')
                    ->icon(fn ($state) => $state === '1' ? 'heroicon-o-check-circle' : 'heroicon-o-document-text')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state == '1' ? 'Published' : 'Draft')
                    ->color(fn ($state) => $state == '1' ? 'success' : 'warning'),

                TextColumn::make('d_wbls_protect')
                    ->label('Tanggal Dibuat')
                    ->dateTime('d-m-Y H:i'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
