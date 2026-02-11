<?php

namespace App\Filament\Resources\Faqs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FaqsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('i_wbls_faqseq', 'asc')
            ->reorderable('i_wbls_faq')
            ->columns([
                TextColumn::make('i_wbls_faqseq')
                    ->label('Urutan Tampil')
                    ->sortable(query: function ($query, $direction) {
                        $query->orderByRaw("CAST(i_wbls_faqseq AS UNSIGNED) $direction");
                    }),

                TextColumn::make('e_wbls_faqquest')
                    ->label('Pertanyaan')
                    ->searchable()
                    ->wrap(),

                TextColumn::make('e_wbls_faqans')
                    ->label('Jawaban')
                    ->searchable()
                    ->wrap()
                    ->html(),

                TextColumn::make('f_wbls_faqstat')
                    ->label('Status')
                    ->icon(fn ($state) => $state === '1' ? 'heroicon-o-check-circle' : 'heroicon-o-document-text')
                    ->badge()
                    ->formatStateUsing(fn ($state) =>
                        $state === '1' ? 'Published' : 'Draft'
                    )
                    ->color(fn ($state) =>
                        $state === '1' ? 'success' : 'warning'
                    ),
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
            ])
            ->defaultSort('i_wbls_faqseq');
    }
}
