<?php

namespace App\Filament\Resources\Referensis\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;

class ReferensiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('c_wbls_categ')
                    ->label('Kode')
                    ->required()
                    ->numeric()
                    ->unique(ignoreRecord: true),

                TextInput::make('n_wbls_categ')
                    ->label('Nama Kategori')
                    ->required()
                    ->maxLength(100),

                RichEditor::make('e_wbls_categ')
                    ->label('Deskripsi')
                    ->required()
                    ->maxLength(100)
                    ->columnSpanFull()
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('faq')
                    ->fileAttachmentsVisibility('public'),
            ]);
    }
}
