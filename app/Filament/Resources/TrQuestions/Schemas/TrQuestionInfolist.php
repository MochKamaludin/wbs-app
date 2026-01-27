<?php

namespace App\Filament\Resources\TrQuestions\Infolists;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\RepeatableEntry;

class TrQuestionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([ 
                Section::make('Informasi Pertanyaan')
                    ->schema([
                        TextEntry::make('kategori.n_wbls_categ')
                            ->label('Kategori'),

                        TextEntry::make('i_question_sort')
                            ->label('Urutan'),

                        TextEntry::make('c_question')
                            ->label('Jenis Pertanyaan')
                            ->formatStateUsing(fn ($state) => match ($state) {
                                1 => 'Field',
                                2 => 'Radio Button',
                                3 => 'Text Area',
                                4 => 'Radio + Text Area',
                                5 => 'Dropdown',
                                6 => 'Currency (Dropdown + Field)',
                                7 => 'File Upload',
                                default => '-',
                            })
                            ->badge(),

                        TextEntry::make('n_question')
                            ->label('Pertanyaan'),

                        IconEntry::make('f_required')
                            ->label('Wajib')
                            ->boolean(),

                        IconEntry::make('f_active')
                            ->label('Aktif')
                            ->boolean(),
                    ])
                    ->columns(2),

                Section::make('Pilihan Jawaban')
                    ->schema([
                        RepeatableEntry::make('choices')
                            ->schema([
                                TextEntry::make('i_choice_sort')
                                    ->label('Urutan'),

                                TextEntry::make('n_choice')
                                    ->label('Pilihan'),

                                IconEntry::make('f_active')
                                    ->label('Aktif')
                                    ->boolean(),
                            ])
                            ->columns(3),
                    ])
                    ->visible(fn ($record) =>
                        in_array($record->c_question, [2, 4, 5, 6])
                    ),
            ]);
    }
}
