<?php

namespace App\Filament\Resources\CaraMelapors\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CaraMelaporsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('n_wbls_proc')
                    ->label('Judul Cara Melapor')
                    ->searchable()
                    ->wrap(),

                TextColumn::make('e_wbls_proc')
                    ->label('Deskripsi')
                    ->searchable()
                    ->wrap()
                    ->html(),

                TextColumn::make('f_wbls_procstat')
                    ->label('Status')
                    ->icon(fn ($state) => $state === '1' ? 'heroicon-o-check-circle' : 'heroicon-o-document-text')
                    ->badge()
                    ->formatStateUsing(fn ($state) =>
                        $state === '1' ? 'Published' : 'Draft'
                    )
                    ->color(fn ($state) =>
                        $state === '1' ? 'success' : 'warning'
                    ),

                TextColumn::make('d_wbls_proc')
                    ->label('Tanggal')
                    ->dateTime('d-m-Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make()
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
