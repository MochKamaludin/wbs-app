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
                        
                        TextEntry::make('i_entry')
                            ->label('Dibuat Oleh')
                            ->formatStateUsing(fn ($state) => match ($state) {
                                '0' => 'Admin',
                                '1' => 'Verifikator',
                                '2' => 'Investigator',
                                default => '-',
                            }),

                        TextEntry::make('d_entry')
                            ->label('Tanggal Dibuat')
                            ->dateTime('d M Y H:i'),

                        TextEntry::make('i_update')
                            ->label('Diubah Oleh')
                            ->formatStateUsing(fn ($state) => match ($state) {
                                '0' => 'Admin',
                                '1' => 'Verifikator',
                                '2' => 'Investigator',
                                default => '-',
                            })
                            ->placeholder('Belum Diubah'),

                        TextEntry::make('d_update')
                            ->label('Tanggal Diubah')
                            ->dateTime('d M Y H:i')
                            ->placeholder('Belum Diubah'),
                            ])
                    ->columns(2),

                Section::make('Pilihan Jawaban')
                    ->schema([
                        RepeatableEntry::make('choices')
                            ->label('Pilihan')
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
