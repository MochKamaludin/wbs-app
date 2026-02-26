<?php

namespace App\Filament\Resources\CaraMelapors\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CaraMelaporInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextEntry::make('n_wbls_proc')
                            ->label('Judul')
                            ->columnSpanFull(),
                        
                        TextEntry::make('e_wbls_proc')
                            ->label('Deskripsi')
                            ->alignJustify()
                            ->html(),

                        TextEntry::make('c_wbls_procord')
                            ->label('Urutan')
                            ->placeholder('-'),

                        TextEntry::make('user.n_wbls_adm')
                            ->label('Dibuat Oleh')
                            ->placeholder('-'),

                        TextEntry::make('f_wbls_procstat')
                            ->label('Status')
                            ->icon(fn ($state) => $state === '1' ? 'heroicon-o-check-circle' : 'heroicon-o-document-text')
                            ->badge()
                            ->color(fn ($state) => $state === '1' ? 'success' : 'warning')
                            ->formatStateUsing(fn ($state) => $state === '1' ? 'Published' : 'Draft'),

                        TextEntry::make('d_wbls_proc')
                            ->label('Tanggal Dibuat')
                            ->dateTime('d M Y H:i'),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
