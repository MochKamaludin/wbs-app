<?php

namespace App\Filament\Resources\WaktuDigunakans\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class WaktuDigunakanInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextEntry::make('n_wbls_about')
                            ->label('Judul'),

                        TextEntry::make('e_wbls_about')
                            ->label('Deskripsi')
                            ->html()
                            ->alignJustify(),

                        TextEntry::make('user.n_wbls_adm')
                            ->label('Dibuat Oleh'),

                        TextEntry::make('d_wbls_about')
                            ->label('Tanggal')
                            ->dateTime(),
                    ])
              ->columnSpanFull(),
              ]);
    }
}
