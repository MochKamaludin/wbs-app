<?php

namespace App\Filament\Resources\TrQuestions\Tables;

use App\Models\ReferensiKategori;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;

class TrQuestionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('i_question_sort', 'asc')
            ->reorderable('i_question_sort')
            ->columns([
                TextColumn::make('i_question_sort')
                    ->label('Urutan Pertanyaan')
                    ->sortable(),

                TextColumn::make('kategori.n_wbls_categ')
                    ->label('Kategori')
                    ->searchable(),

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
            ])
            
            ->filters([
                SelectFilter::make('c_wbls_categ')
                    ->label('Kategori Pelanggaran')
                    ->options(
                        ReferensiKategori::pluck('n_wbls_categ', 'c_wbls_categ')->toArray()
                    )
                    ->searchable()
                    ->placeholder('Semua Kategori')
                    ->default(1),
            ], layout: FiltersLayout::AboveContent)

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