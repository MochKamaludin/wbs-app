<?php

namespace App\Filament\Resources\Faqs\Schemas;

use App\Models\Faq;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextArea::make('e_wbls_faqquest')
                    ->label('Pertanyaan')
                    ->required()
                    ->maxLength(100),

                TextInput::make('i_wbls_faqseq')
                    ->label('Urutan Tampil')
                    ->numeric()
                    ->required()
                    ->minValue(1)
                    ->default(fn () => (FAQ::max('i_wbls_faqseq') ?? 0) + 1)
                    // ->default(function () {
                    //     $last = Faq::max('i_wbls_faqseq');
                    //     return $last ? $last + 1 : 1;
                    // })
                    ->unique(
                        table: Faq::class,
                        column: 'i_wbls_faqseq',
                        ignoreRecord: true
                    )
                    ->validationMessages([
                        'unique' => 'No urut sudah digunakan',
                    ]),

                RichEditor::make('e_wbls_faqans')
                    ->label('Jawaban')
                    ->required()
                    ->columnSpanFull()
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('faq')
                    ->fileAttachmentsVisibility('public'),

                Toggle::make('f_wbls_faqstat')
                    ->label('Publish')
                    ->default(true)
                    ->onColor('success')
                    ->offColor('gray'),
            ]);
    }
}
