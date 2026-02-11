<?php

namespace App\Filament\Resources\DefinisiWbs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DefinisiWbsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('n_wbls_about')
                    ->label('Judul')
                    ->searchable(),

                TextColumn::make('user.n_wbls_adm')
                    ->label('Dibuat Oleh')
                    ->placeholder('-'),


                TextColumn::make('d_wbls_about')
                    ->label('Tanggal Dibuat')
                    ->dateTime('d M Y H:i'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ]);
    }
}
