<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([

            TextInput::make('i_wbls_adm')
                ->label('Email')
                ->email()
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(100),

            TextInput::make('n_wbls_adm')
                ->label('Nama Lengkap')
                ->required()
                ->maxLength(100),

            TextInput::make('i_emp')
                ->label('NIP')
                ->numeric()                 // ❌ huruf tidak bisa diketik
                ->maxLength(6)              // ❌ tidak bisa lebih dari 6
                ->rule('digits:6')          // ❌ validasi backend
                ->inputMode('numeric')      // keyboard angka (mobile)
                ->autocomplete(false)
                ->required(),

            Select::make('c_wbls_admauth')
                ->label('Role')
                ->options([
                    '0' => 'Administrator',
                    '1' => 'Admin Verifikator',
                    '2' => 'Admin Investigator',
                ])
                ->required(),

            TextInput::make('password')
                ->label('Password')
                ->password()
                ->required(fn (string $context) => $context === 'create')
                ->hiddenOn('view')
                ->revealable()
                ->dehydrated(fn ($state) => filled($state)),


        ]);
    }
}
