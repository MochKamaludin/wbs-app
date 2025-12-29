<?php

namespace App\Filament\Resources\TujuanWbs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TujuanWbsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('n_wbls_purpose')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('c_wbls_purposeord')
                    ->label('Urutan')
                    ->sortable(),

                TextColumn::make('f_wbls_purposestat')
                    ->label('Status')
                    ->badge()
                    ->state(fn ($record) => $record->f_wbls_purposestat === '1' ? '1' : '0')
                    ->color(fn ($state) => $state === '1' ? 'success' : 'warning')
                    ->formatStateUsing(fn ($state) => $state === '1' ? 'Publish' : 'Draft'),

                TextColumn::make('user.n_wbls_adm')
                    ->label('Dibuat Oleh')
                    ->placeholder('-'),

                TextColumn::make('d_wbls_purpose')
                    ->label('Tanggal')
                    ->dateTime('d-m-Y H:i')
                    ->sortable(),
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
