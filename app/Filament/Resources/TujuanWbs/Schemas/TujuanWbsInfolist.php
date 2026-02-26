<?php

namespace App\Filament\Resources\TujuanWbs\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TujuanWbsInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextEntry::make('n_wbls_purpose')
                            ->label('Judul'),

                        TextEntry::make('e_wbls_purpose')
                            ->label('Deskripsi')
                            ->html()
                            ->alignJustify(),

                        TextEntry::make('c_wbls_purposeord')
                            ->label('Urutan Tampilan')
                            ->placeholder('-'),

                        TextEntry::make('f_wbls_purposestat')
                            ->label('Status')
                            ->icon(fn ($state) => $state === '1' ? 'heroicon-o-check-circle' : 'heroicon-o-document-text')
                            ->badge()
                            ->state(fn ($record) => $record->f_wbls_purposestat === '1' ? '1' : '0')
                            ->color(fn ($state) => $state === '1' ? 'success' : 'warning')
                            ->formatStateUsing(fn ($state) => $state === '1' ? 'Published' : 'Draft'),

                        TextEntry::make('user.n_wbls_adm')
                            ->label('Dibuat Oleh')
                            ->placeholder('-'),

                        TextEntry::make('d_wbls_purpose')
                            ->label('Tanggal')
                            ->dateTime('d-m-Y H:i'),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
