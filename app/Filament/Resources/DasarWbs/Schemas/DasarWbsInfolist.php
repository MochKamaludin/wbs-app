<?php

namespace App\Filament\Resources\DasarWbs\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DasarWbsInfolist
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
                                        TextEntry::make('n_wbls_about')
                                            ->label('Judul'),
                                        TextEntry::make('user.n_wbls_adm')
                                            ->label('Dibuat Oleh'),
                                        TextEntry::make('d_wbls_about')
                                            ->label('Tanggal')
                                            ->dateTime(),
                                    ]),
                                ]),
                        ])->from('lg'),
                    ]),
            Section::make('Deskripsi')
              ->schema([
                  TextEntry::make('e_wbls_about')
                      ->html()
                      ->alignJustify()
                      ->hiddenLabel(),
              ])
              ->collapsible(),
            ]);
    }
}
