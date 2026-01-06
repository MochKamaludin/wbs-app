<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserInfolist
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
                                        TextEntry::make('i_wbls_adm')
                                            ->icon('heroicon-m-envelope')
                                            ->label('Email'),

                                        TextEntry::make('n_wbls_adm')
                                            ->label('Nama Lengkap'),

                                        TextEntry::make('i_emp')
                                            ->label('NIP'),
                                    ]),
                                ]),
                        ]),
                    ]),
                Section::make()
                    ->schema([
                        Flex::make([
                            Grid::make(2)
                                ->schema([
                                    Group::make([
                                        TextEntry::make('c_wbls_admauth')
                                            ->label('Role')
                                            ->formatStateUsing(fn ($state) => match ($state) {
                                                '0' => 'Admin',
                                                '1' => 'Operator',
                                                '2' => 'Verifikator',
                                                default => 'Tidak Diketahui',
                                            }),

                                        TextEntry::make('i_entry')
                                            ->label('Dibuat Oleh'),

                                        TextEntry::make('d_entry')
                                            ->label('Tanggal Entry')
                                            ->dateTime('d M Y H:i'),
                                    ]),
                                ]),
                        ]),
                    ]),
                ]);
    }
}