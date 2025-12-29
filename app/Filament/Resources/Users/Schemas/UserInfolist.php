<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([

            TextEntry::make('i_wbls_adm')
                ->label('Email'),

            TextEntry::make('n_wbls_adm')
                ->label('Nama Lengkap'),

            TextEntry::make('i_emp')
                ->label('NIP'),

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

        ]);
    }
}