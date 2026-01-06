<?php

namespace App\Filament\Resources\CaraMelapors\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;

class CaraMelaporForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('n_wbls_proc')
                    ->label('Judul Cara Melapor')
                    ->required()
                    ->maxLength(100),

                RichEditor::make('e_wbls_proc')
                    ->label('Deskripsi')
                    ->required()
                    ->columnSpanFull()
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('faq')
                    ->fileAttachmentsVisibility('public'),


                TextInput::make('c_wbls_procord')
                    ->label('Urutan Tampil')
                    ->numeric()
                    ->maxLength(10),

                Toggle::make('f_wbls_procstat')
                    ->label('Publish')
                    ->default(false)
                    ->onColor('success')
                    ->offColor('gray'),
            ]);
    }
}
