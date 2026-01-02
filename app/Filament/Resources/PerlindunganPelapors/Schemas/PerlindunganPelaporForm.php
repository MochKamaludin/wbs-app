<?php

namespace App\Filament\Resources\PerlindunganPelapors\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;

class PerlindunganPelaporForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('n_wbls_protect')
                    ->label('Judul')
                    ->required(),

                RichEditor::make('e_wbls_protect')
                    ->label('Deskripsi')
                    ->required()
                    ->columnSpanFull()
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('faq')
                    ->fileAttachmentsVisibility('public'),

                TextInput::make('c_wbls_protectord')
                    ->label('Urutan')
                    ->numeric()
                    ->maxLength(1),

                Toggle::make('f_wbls_protectstat')
                    ->label('Publish')
                    ->default(true),
            ]);
    }
}
