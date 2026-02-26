<?php

namespace App\Filament\Resources\ReferensiStatuses\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\RichEditor;

class ReferensiStatusForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
            TextInput::make('n_wbls_stat')
                ->label('Nama Status')
                ->required()
                ->maxLength(100),

            RichEditor::make('e_wbls_stat')
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