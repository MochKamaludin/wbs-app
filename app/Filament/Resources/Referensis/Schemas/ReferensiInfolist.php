<?php

namespace App\Filament\Resources\Referensis\Schemas;

use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\SpatieTagsEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ReferensiInfolist
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
                                        TextEntry::make('c_wbls_categ')
                                            ->label('Kode'),

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