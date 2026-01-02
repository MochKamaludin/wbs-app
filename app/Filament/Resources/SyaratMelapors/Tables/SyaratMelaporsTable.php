<?php

namespace App\Filament\Resources\SyaratMelapors\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\DeleteAction;

class SyaratMelaporsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('n_wbls_req')
                ->label('Judul')
                ->searchable()
                ->sortable(),

            TextColumn::make('c_wbls_reqord')
                ->label('Urutan')
                ->sortable(),

            TextColumn::make('f_wbls_reqstat')
                ->label('Status')
                ->badge()
                ->state(fn ($record) => (string) $record->f_wbls_reqstat)
                ->color(fn ($state) => $state === '1' ? 'success' : 'gray')
                ->formatStateUsing(fn ($state) =>
                    $state === '1' ? 'Publish' : 'Draft'
                ),

            TextColumn::make('user.n_wbls_adm')
                ->label('Dibuat Oleh')
                ->placeholder('-'),

            TextColumn::make('d_entry')
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
