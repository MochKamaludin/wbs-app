<?php

namespace App\Filament\Resources\PerlindunganPelapors\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PerlindunganPelaporInfolist
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
                                        TextEntry::make('n_wbls_protect')
                                            ->label('Judul')
                                            ->weight('bold'),

                                        TextEntry::make('c_wbls_protectord')
                                            ->label('Urutan')
                                            ->placeholder('-'),

                                        TextEntry::make('f_wbls_protectstat')
                                            ->label('Status')
                                            ->badge()
                                            ->state(fn ($record) => $record->f_wbls_protectstat === '1' ? '1' : '0')
                                            ->color(fn ($state) => $state === '1' ? 'success' : 'warning')
                                            ->formatStateUsing(fn ($state) => $state === '1' ? 'Publish' : 'Draft'),

                                        TextEntry::make('user.n_wbls_adm')
                                            ->label('Dibuat Oleh')
                                            ->placeholder('-'),

                                        TextEntry::make('d_wbls_protect')
                                            ->label('Tanggal')
                                            ->dateTime('d-m-Y H:i'),
                                    ]),
                                ]),
                        ])->from('lg'),
                    ]),
        Section::make('Deskripsi')
        ->schema([
            TextEntry::make('e_wbls_protect')
                ->html()
                ->hiddenLabel()
                ->alignJustify(),
        ])
        ->collapsible(),
        ]);
    }
}
