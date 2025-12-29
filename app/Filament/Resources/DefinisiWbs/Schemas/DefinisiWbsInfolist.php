<?php

namespace App\Filament\Resources\DefinisiWbs\Schemas;

use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry;

class DefinisiWbsInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('n_wbls_about')
                    ->label('Judul'),

                TextEntry::make('e_wbls_about')
                    ->label('Deskripsi')
                    ->html()
                    ->alignJustify()
                    ->columnSpanFull(),

                TextEntry::make('user.n_wbls_adm')
                    ->label('Dibuat Oleh'),

                TextEntry::make('d_wbls_about')
                    ->label('Tanggal')
                    ->dateTime(),
            ]);
    }
}
