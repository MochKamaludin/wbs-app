<?php

namespace App\Filament\Resources\TrQuestions\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\{
    TextInput,
    Select,
    Textarea,
    Toggle,
    Repeater
};

class TrQuestionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('i_id_xxx')
                    ->label('Topik')
                    ->numeric()
                    ->required(),

                Select::make('c_question')
                    ->label('Jenis Pertanyaan')
                    ->options([
                        1 => 'Field',
                        2 => 'Radio Button',
                        3 => 'Text Area',
                        4 => 'Radio + Text Area',
                        5 => 'Dropdown',
                        6 => 'Currency (Dropdown + Field)',
                        7 => 'File Upload',
                    ])
                    ->reactive()
                    ->required(),

                TextInput::make('i_question_sort')
                    ->label('Urutan Pertanyaan')
                    ->numeric()
                    ->required(),

                Textarea::make('n_question')
                    ->label('Teks Pertanyaan')
                    ->required(),

                Toggle::make('f_required')
                    ->label('Wajib Diisi')
                    ->default(true),

                Toggle::make('f_active')
                    ->label('Status Aktif')
                    ->default(true),

                Repeater::make('choices')
                    ->label('Pilihan Jawaban')
                    ->schema([
                        TextInput::make('i_choice_sort')
                            ->label('Urutan')
                            ->numeric()
                            ->required(),

                        TextInput::make('n_choice')
                            ->label('Pilihan')
                            ->required(),

                        Toggle::make('f_active')
                            ->label('Aktif')
                            ->default(true),
                    ])
                    ->visible(fn ($get) => in_array(
                        $get('c_question'),
                        [2, 4, 5, 6] 
                    ))
                    ->minItems(1)
                    ->defaultItems(1)
                    ->collapsible(),
            ]);
    }
}
