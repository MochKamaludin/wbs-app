<?php

namespace App\Filament\Resources\TujuanWbs\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TujuanWbsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('n_wbls_purpose')
                    ->label('Judul')
                    ->required()
                    ->maxLength(100),

                RichEditor::make('e_wbls_purpose')
                    ->label('Deskripsi')
                    ->required()
                    ->columnSpanFull(),

                TextInput::make('c_wbls_purposeord')
                    ->label('Urutan Tampilan')
                    ->numeric()
                    ->maxLength(1),

                Toggle::make('f_wbls_purposestat')
                    ->label('Publish')
                    ->onColor('success')
                    ->offColor('gray')
                    ->default(true),

            ]);
    }
}
