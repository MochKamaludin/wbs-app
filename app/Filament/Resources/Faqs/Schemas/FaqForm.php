<?php

namespace App\Filament\Resources\Faqs\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('e_wbls_faqquest')
                    ->label('Pertanyaan')
                    ->required()
                    ->maxLength(100),

                RichEditor::make('e_wbls_faqans')
                    ->label('Jawaban')
                    ->required()
                    ->columnSpanFull()
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('faq')
                    ->fileAttachmentsVisibility('public'),


                TextInput::make('i_wbls_faqseq')
                    ->label('Urutan Tampil')
                    ->numeric()
                    ->maxLength(3)
                    ->required(),

                Toggle::make('f_wbls_faqstat')
                    ->label('Publish')
                    ->default(false)
                    ->onColor('success')
                    ->offColor('gray'),
            ]);
    }
}
