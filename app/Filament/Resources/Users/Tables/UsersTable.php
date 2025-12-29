<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('i_wbls_adm')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('n_wbls_adm')
                    ->label('Nama')
                    ->searchable(),

                TextColumn::make('i_emp')
                    ->label('NIP')
                    ->searchable(),

                TextColumn::make('c_wbls_admauth')
                    ->label('Role')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        '0' => 'Admin',
                        '1' => 'Operator',
                        '2' => 'Verifikator',
                        default => 'Tidak Diketahui',
                    })
                    ->color(fn ($state) => match ($state) {
                        '0' => 'danger',
                        '1' => 'info',
                        '2' => 'success',
                        default => 'gray',
                    }),


                TextColumn::make('i_entry')
                    ->label('Dibuat Oleh'),

                TextColumn::make('d_entry')
                    ->label('Tanggal Entry')
                    ->dateTime('d M Y H:i')
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
