<?php

namespace App\Filament\Resources\WbsVerifications\Schemas;

use App\Models\File;
use App\Models\Jawaban;
use App\Models\Pengaduan;
use App\Models\Pertanyaan;
use App\Models\PilihanPertanyaan;
use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Support\Facades\DB;


class WbsVerificationInfolist
{
    public static function configure(Schema $schema): Schema
    {
    return $schema->components([
        Tabs::make('Tabs')
            ->contained(false)
            ->columnSpanFull()
            ->tabs([

                Tab::make('Detail Laporan')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        TextEntry::make('i_wbls')
                            ->label('Nomor WBS'),

                        TextEntry::make('d_wbls_incident')
                            ->label('Perkiraan Waktu Kejadian'),

                        TextEntry::make('kategori.n_wbls_categ')
                            ->label('Perihal'),

                        TextEntry::make('d_wbls')
                            ->label('Tanggal Pengaduan')
                            ->dateTime('d M Y H:i'),

                        TextEntry::make('e_wbls')
                            ->label('Uraian'),
                        
                        TextEntry::make('status.n_wbls_stat')
                            ->label('Status'),

                        TextEntry::make('e_wbls_stat')
                            ->label('Keterangan')
                            ->html(),
                    ]),

                Tab::make('Jawaban Pertanyaan')
                        ->icon('heroicon-o-archive-box')
                        ->schema([

                            RepeatableEntry::make('jawaban')
                                ->label('Jawaban Pertanyaan')
                                ->state(function (Pengaduan $record) {
                                    $questions = Pertanyaan::where('c_wbls_categ', $record->c_wbls_categ)
                                        ->where('f_active', 1)
                                        ->where('c_question', '!=', 7) 
                                        ->orderBy('i_question_sort')
                                        ->get();

                                    $answers = Jawaban::where('i_wbls', $record->i_wbls)
                                        ->get()
                                        ->keyBy('i_id_question');

                                    return $questions->map(function ($question) use ($answers) {

                                    $answer = $answers->get($question->i_id_question);

                                    $jawaban = '-';

                                    if ($answer) {

                                        $choiceText = null;
                                        $textAnswer = null;

                                        if ($answer->i_id_questionchoice) {

                                            $choice = PilihanPertanyaan::find($answer->i_id_questionchoice);
                                            $choiceText = $choice?->n_choice;
                                        }

                                        if ($answer->e_answer && is_string($answer->e_answer)) {

                                            $decoded = json_decode($answer->e_answer, true);

                                            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {

                                                if (!empty($decoded['choice'])) {
                                                    $choice = PilihanPertanyaan::find($decoded['choice']);
                                                    $choiceText = $choice?->n_choice;
                                                }

                                                $textAnswer = $decoded['text'] ?? null;

                                            } else {
                                                $textAnswer = $answer->e_answer;
                                            }
                                        }
                                        if ($choiceText && $textAnswer) {
                                            $jawaban = $choiceText . "\n" . $textAnswer;
                                        } elseif ($choiceText) {
                                            $jawaban = $choiceText;
                                        } elseif ($textAnswer) {
                                            $jawaban = $textAnswer;
                                        }
                                    }

                                    return [
                                        'pertanyaan' => $question->n_question,
                                        'jawaban'    => $jawaban,
                                    ];
                                });
                                })
                                ->schema([
                                    TextEntry::make('pertanyaan')
                                        ->label('Pertanyaan')
                                        ->columnSpanFull(),

                                    TextEntry::make('jawaban')
                                        ->label('Jawaban')
                                        ->columnSpanFull()
                                        ->extraAttributes(['style' => 'white-space: pre-line;'])
                                ]),
                        ]),

                    Tab::make('Bukti')
                        ->icon('heroicon-o-document')
                        ->schema([

                            RepeatableEntry::make('files')
                                ->label('File Bukti')
                                ->state(function (Pengaduan $record) {

                                    $files = File::where('i_wbls', $record->i_wbls)->get();

                                    if ($files->isEmpty()) {
                                        return [];
                                    }

                                    return $files->groupBy('i_id_question')
                                        ->map(function ($group) {

                                            $firstFile = $group->first();

                                            $question = Pertanyaan::find($firstFile->i_id_question);

                                            $fileCategory = DB::table('trwblsfilecateg')
                                                ->where('c_wbls_filecateg', $firstFile->c_wbls_filecateg)
                                                ->value('n_wbls_filecateg');

                                            return [
                                                'pertanyaan' => $question?->n_question ?? 'Pertanyaan tidak ditemukan',
                                                'kategori'   => $fileCategory ?? 'Tidak ada kategori',
                                                'files'      => $group->map(function ($file, $index) {
                                                    return [
                                                        'label' => 'Bukti ' . ($index + 1),
                                                        'filename' => $file->n_wbls_file,
                                                    ];
                                                })->values()->toArray(),
                                            ];
                                        })
                                        ->values()
                                        ->toArray();
                                })
                                ->schema([

                                    TextEntry::make('pertanyaan')
                                        ->label('Pertanyaan')
                                        ->columnSpanFull(),

                                    TextEntry::make('kategori')
                                        ->label('Kategori'),

                                    RepeatableEntry::make('files')
                                        ->label('Daftar Bukti')
                                        ->schema([

                                            TextEntry::make('label')
                                                ->label('')
                                                ->columnSpan(1),

                                            TextEntry::make('filename')
                                                ->label('File')
                                                ->formatStateUsing(fn () => 'Download')
                                                ->url(fn ($state) => route('wbs.download', [
                                                    'filename' => $state,
                                                ]))
                                                ->openUrlInNewTab()
                                                ->color('primary')
                                                ->icon('')
                                                ->extraAttributes([
                                                    'class' => 'inline-flex items-center px-3 py-1.5 bg-primary-600 text-white rounded-lg text-sm font-medium hover:bg-primary-700 transition',
                                                ]),
                                        ])
                                        ->columnSpanFull(),
                                ])
                                ->visible(fn (Pengaduan $record) =>
                                    File::where('i_wbls', $record->i_wbls)->exists()
                                ),

                            TextEntry::make('kosong')
                                ->label('')
                                ->state('Tidak ada file bukti')
                                ->columnSpanFull()
                                ->visible(fn (Pengaduan $record) =>
                                    !File::where('i_wbls', $record->i_wbls)->exists()
                                ),
                        ]),
                ]),
        ]);
    }
}