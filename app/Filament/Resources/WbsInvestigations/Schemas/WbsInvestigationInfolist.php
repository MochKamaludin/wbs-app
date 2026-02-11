<?php

namespace App\Filament\Resources\WbsInvestigations\Schemas;

use Filament\Schemas\Schema;
use App\Models\TmAnswer;
use App\Models\Tmwbls;
use App\Models\TmwblsFile;
use App\Models\TrQuestion;
use Filament\Actions\Action;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Support\Facades\URL;

use Filament\Schemas\Components\Actions;

class WbsInvestigationInfolist
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

                            TextEntry::make('kategori.n_wbls_categ')
                                ->label('Kategori'),

                            TextEntry::make('d_wbls')
                                ->label('Tanggal Lapor')
                                ->dateTime('d/m/Y H:i'),

                            TextEntry::make('d_wbls_incident')
                                ->label('Perkiraan Waktu Kejadian'),

                            TextEntry::make('e_wbls')
                                ->label('Uraian Kejadian'),
                            
                            TextEntry::make('status.n_wbls_stat')
                                ->label('Status'),

                            TextEntry::make('e_wbls_stat')
                                ->label('Keterangan Status')
                                ->placeholder('-')
                                ->html(),
                        ]),

                    Tab::make('Jawaban Pertanyaan')
                        ->icon('heroicon-o-archive-box')
                        ->schema([

                            RepeatableEntry::make('jawaban')
                                ->label('Jawaban Pertanyaan')
                                ->state(function (Tmwbls $record) {
                                    $questions = TrQuestion::where('c_wbls_categ', $record->c_wbls_categ)
                                        ->where('f_active', 1)
                                        ->where('c_question', '!=', 7) 
                                        ->orderBy('i_question_sort')
                                        ->get();

                                    $answers = TmAnswer::where('i_wbls', $record->i_wbls)
                                        ->get()
                                        ->keyBy('i_id_question');

                                    return $questions->map(function ($question) use ($answers) {
                                        $answer = $answers->get($question->i_id_question);
                                        
                                        return [
                                            'pertanyaan' => $question->n_question,
                                            'jawaban' => $answer?->choice?->n_choice ?? $answer?->e_answer ?? '-',
                                        ];
                                    });
                                })
                                ->schema([
                                    TextEntry::make('pertanyaan')
                                        ->label('Pertanyaan')
                                        ->columnSpanFull(),

                                    TextEntry::make('jawaban')
                                        ->label('Jawaban')
                                        ->columnSpanFull(),
                                ]),
                        ]),

                    Tab::make('Bukti')
                        ->icon('heroicon-o-document')
                        ->schema([

                            RepeatableEntry::make('files')
                                ->label('File Bukti')
                                ->state(function (Tmwbls $record) {

                                    $files = TmwblsFile::where('i_wbls', $record->i_wbls)->get();

                                    if ($files->isEmpty()) {
                                        return [];
                                    }

                                    return $files->groupBy('i_id_question')
                                        ->map(function ($group) {

                                            $firstFile = $group->first();

                                            $question = TrQuestion::find($firstFile->i_id_question);

                                            $fileCategory = \Illuminate\Support\Facades\DB::table('trwblsfilecateg')
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
                                ->visible(fn (Tmwbls $record) =>
                                    TmwblsFile::where('i_wbls', $record->i_wbls)->exists()
                                ),

                            TextEntry::make('kosong')
                                ->label('')
                                ->state('Tidak ada file bukti')
                                ->columnSpanFull()
                                ->visible(fn (Tmwbls $record) =>
                                    !TmwblsFile::where('i_wbls', $record->i_wbls)->exists()
                                ),
                        ]),
                ]),
        ]);
    }
}