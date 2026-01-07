<?php

namespace App\Filament\Resources\SyaratMelapors\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SyaratMelaporInfolist
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
                                        TextEntry::make('n_wbls_req')
                                            ->label('Judul'),
                                        TextEntry::make('c_wbls_reqord')
                                            ->label('Urutan Tampilan')
                                            ->placeholder('-'),

                                        TextEntry::make('f_wbls_reqstat')
                                            ->label('Status')
                                            ->icon(fn ($state) => $state === '1' ? 'heroicon-o-check-circle' : 'heroicon-o-document-text')
                                            ->badge()
                                            ->state(fn ($record) => $record->f_wbls_reqstat === '1' ? '1' : '0')
                                            ->color(fn ($state) => $state === '1' ? 'success' : 'warning')
                                            ->formatStateUsing(fn ($state) => $state === '1' ? 'Published' : 'Draft'),

                                        TextEntry::make('user.n_wbls_adm')
                                            ->label('Dibuat Oleh')
                                            ->placeholder('-'),

                                        TextEntry::make('d_wbls_req')
                                            ->label('Tanggal')
                                            ->dateTime('d-m-Y H:i'),
                                    ]),
                                ]),
                        ])->from('lg'),
                    ]),
            Section::make('Deskripsi')
              ->schema([
                  TextEntry::make('e_wbls_req')
                      ->html()
                      ->alignJustify()
                      ->hiddenLabel(),
              ])
              ->collapsible(),
            ]);
    }
}