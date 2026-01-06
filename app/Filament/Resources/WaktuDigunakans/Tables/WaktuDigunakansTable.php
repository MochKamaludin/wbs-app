<?php

namespace App\Filament\Resources\WaktuDigunakans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class WaktuDigunakansTable
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
                    ->label('Tanggal')
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
