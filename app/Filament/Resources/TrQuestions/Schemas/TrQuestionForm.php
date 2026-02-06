<?php

namespace App\Filament\Resources\TrQuestions\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\{
    Hidden,
    TextInput,
    Select,
    Textarea,
    Toggle,
    Repeater
};
use Filament\Schemas\Components\Utilities\Set;
use App\Models\ReferensiKategori;
use App\Models\TrQuestion;
use Filament\Schemas\Components\Utilities\Get;

class TrQuestionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Select::make('c_wbls_categ')
                    ->label('Kategori')
                    ->options(
                        ReferensiKategori::pluck('n_wbls_categ', 'c_wbls_categ')
                    )
                    ->required()
                    ->live()
                    ->afterStateUpdated(function ($state, Set $set) {

                        $lastSort = TrQuestion::where('c_wbls_categ', $state)
                            ->max('i_question_sort');

                        $set('base_question_sort', $lastSort ?? 0);

                        $set('questions', []);
                    }),

                Hidden::make('base_question_sort')
                    ->default(0),
                
                Repeater::make('questions')
                    ->label('Daftar Pertanyaan')
                    ->addActionLabel('Tambah Pertanyaan')
                    ->minItems(1)
                    ->visible(fn (Get $get) => filled($get('c_wbls_categ')))
                    ->schema([

                        TextInput::make('i_question_sort')
                            ->label('Urutan')
                            ->numeric()
                            ->required(),

                        Textarea::make('n_question')
                            ->label('Pertanyaan')
                            ->required(),

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
                            ->required()
                            ->reactive(),

                        Toggle::make('f_required')
                            ->label('Wajib Diisi')
                            ->default(true),

                        Toggle::make('f_active')
                            ->label('Aktif')
                            ->default(true),

                        Repeater::make('choices')
                            ->label('Opsi Jawaban')
                            ->visible(fn (Get $get) =>
                                in_array($get('c_question'), [2, 4, 5, 6])
                            )
                            ->schema([
                                TextInput::make('i_choice_sort')
                                    ->label('Urutan')
                                    ->numeric()
                                    ->required(),

                                TextInput::make('n_choice')
                                    ->label('Opsi')
                                    ->required(),

                                Toggle::make('f_active')
                                    ->label('Aktif')
                                    ->default(true),
                            ])
                            ->afterStateUpdated(function ($state, callable $set) {
                                $used = collect($state)
                                    ->pluck('i_choice_sort')
                                    ->filter();

                                $next = $used->isEmpty()
                                    ? 1
                                    : $used->max() + 1;

                                foreach ($state as $i => $row) {
                                    if (empty($row['i_choice_sort'])) {
                                        $set("choices.$i.i_choice_sort", $next);
                                        break;
                                    }
                                }
                            }),
                    ])
                    ->afterStateUpdated(function ($state, callable $set, Get $get) {

                        $base = (int) $get('base_question_sort');

                        $used = collect($state)
                            ->pluck('i_question_sort')
                            ->filter();

                        $next = $used->isEmpty()
                            ? $base + 1
                            : $used->max() + 1;

                        foreach ($state as $i => $row) {
                            if (empty($row['i_question_sort'])) {
                                $set("questions.$i.i_question_sort", $next);
                                break;
                            }
                        }
                    })
                    ->rules([
                        fn () => function ($attribute, $value, $fail) {
                            $dupes = collect($value)
                                ->pluck('i_question_sort')
                                ->duplicates();

                            if ($dupes->isNotEmpty()) {
                                $fail('Urutan pertanyaan tidak boleh sama.');
                            }
                        }
                    ]),
            ]);
    }
}