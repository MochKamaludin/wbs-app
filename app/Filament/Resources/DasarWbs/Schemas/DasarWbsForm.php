<?php

namespace App\Filament\Resources\DasarWbs\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;

class DasarWbsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('n_wbls_about')
                    ->label('Judul')
                    ->required()
                    ->maxLength(100),

                RichEditor::make('e_wbls_about')
                    ->label('Deskripsi')
                    ->required()
                    ->columnSpanFull()
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('faq')
                    ->fileAttachmentsVisibility('public'),
            ]);
    }
}
