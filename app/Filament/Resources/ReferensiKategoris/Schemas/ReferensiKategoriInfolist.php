<?php

namespace App\Filament\Resources\ReferensiKategoris\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ReferensiKategoriInfolist
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
                                        TextEntry::make('n_wbls_categ')
                                            ->label('Nama Kategori'),
                                    ]),
                                ]),
                        ])->from('lg'),
                    ]),
                Section::make('Deskripsi')
                    ->schema([
                        TextEntry::make('e_wbls_categ')
                            ->alignJustify()
                            ->html()
                            ->hiddenLabel(),
                    ])
                    ->collapsible(),
            ]);
    }
}
