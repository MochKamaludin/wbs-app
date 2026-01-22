<?php

namespace App\Filament\Resources\TrQuestions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class TrQuestionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('i_question_sort')
                    ->label('Urutan Pertanyaan')
                    ->sortable(),

                TextColumn::make('n_question')
                    ->label('Pertanyaan')
                    ->searchable()
                    ->wrap(),

                TextColumn::make('c_question')
                    ->label('Jenis Pertanyaan')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        1 => 'Field',
                        2 => 'Radio Button',
                        3 => 'Text Area',
                        4 => 'Radio + Text Area',
                        5 => 'Dropdown',
                        6 => 'Currency (Dropdown + Field)',
                        7 => 'File Upload',
                        default => 'Tidak Diketahui',
                    }),

                IconColumn::make('f_required')
                    ->label('Wajib Diisi')
                    ->boolean(),

                IconColumn::make('f_active')
                    ->label('Status Aktif')
                    ->boolean(),

                TextColumn::make('i_entry')
                    ->label('Dibuat Oleh')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('d_entry')
                    ->label('Tanggal Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('d_update')
                    ->label('Diubah Oleh')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('d_update')
                    ->label('Tanggal Diubah')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('Hapus Terpilih'),
                ]),
            ]);
    }
}