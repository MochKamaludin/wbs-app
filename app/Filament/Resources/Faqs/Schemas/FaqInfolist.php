<?php

namespace App\Filament\Resources\Faqs\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FaqInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([ 
                Section::make()
                    ->schema([
                        Flex::make([
                            Grid::make(2)
                                ->schema([
                                    Group::make([
                                        TextEntry::make('e_wbls_faqquest')
                                            ->label('Pertanyaan')
                                            ->columnSpanFull(),
                                        TextEntry::make('i_wbls_faqseq')
                                            ->label('Urutan')
                                            ->placeholder('-'),
                                        TextEntry::make('user.n_wbls_adm')
                                            ->label('Dibuat Oleh')
                                            ->placeholder('-'),
                                        TextEntry::make('f_wbls_faqstat')
                                            ->label('Status')
                                            ->icon(fn ($state) => $state === '1' ? 'heroicon-o-check-circle' : 'heroicon-o-document-text')
                                            ->badge()
                                            ->color(fn ($state) => $state === '1' ? 'success' : 'warning')
                                            ->formatStateUsing(fn ($state) => $state === '1' ? 'Published' : 'Draft'),

                                        TextEntry::make('d_wbls_faq')
                                            ->label('Tanggal Dibuat')
                                            ->dateTime('d M Y H:i'),
                                    ]),
                                ]),
                        ])->from('lg'),
                    ]),
                Section::make('Jawaban')
                    ->schema([
                        TextEntry::make('e_wbls_faqans')
                            ->alignJustify()
                            ->html()
                            ->hiddenLabel(),
                    ])
                    ->collapsible(),
            ]);
    }
}
