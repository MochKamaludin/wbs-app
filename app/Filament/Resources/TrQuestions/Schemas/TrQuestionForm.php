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
use Illuminate\Support\Facades\DB;
use App\Models\ReferensiKategori;

class TrQuestionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
            Select::make('c_wbls_categ')
                ->label('Kategori WBS')
                ->options(
                    ReferensiKategori::pluck('n_wbls_categ', 'c_wbls_categ')
                )
                ->required(),

            TextInput::make('n_question')
                ->label('Pertanyaan')
                ->required()
                ->columnSpanFull(),
            
            TextInput::make('i_question_sort')
                ->label('Urutan Pertanyaan')
                ->numeric()
                ->required()
                ->unique(
                    table: 'trquestion',
                    column: 'i_question_sort',
                    ignoreRecord: true,
                    modifyRuleUsing: fn ($rule, $get) =>
                        $rule->where('c_wbls_categ', $get('c_wbls_categ'))
                ),

            Select::make('c_question')
                ->label('Jenis Pertanyaan')
                ->options([
                    1 => 'Field',
                    2 => 'Radio',
                    3 => 'Textarea',
                    4 => 'Radio + Textarea',
                    5 => 'Dropdown',
                    6 => 'Currency',
                    7 => 'File',
                ])
                ->reactive()
                ->required(),

            Toggle::make('f_required')
                ->label('Wajib Diisi')
                ->default(true),

            Toggle::make('f_active')
                ->label('Aktif')
                ->default(true),

            Repeater::make('choices')
                ->label('Opsi Jawaban')
                ->schema([
                    TextInput::make('n_choice')
                        ->label('Opsi')
                        ->required(),

                    TextInput::make('i_choice_sort')
                        ->label('Urutan')
                        ->numeric()
                        ->required(),

                    Toggle::make('f_active')
                        ->label('Aktif')
                        ->default(true),
                ])
                ->columnSpanFull()
                ->visible(fn ($get) => in_array($get('c_question'), [2,4,5,6]))
                ->minItems(1)
                ->defaultItems(0)
                ->collapsible(),
            ]);
    }
}
