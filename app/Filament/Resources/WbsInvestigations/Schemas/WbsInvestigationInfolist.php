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

                            TextEntry::make('e_wbls_stat')
                                ->label('Keterangan Status')
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
                                ->label('File')
                                ->state(function (Tmwbls $record) {
                                    $files = TmwblsFile::where('i_wbls', $record->i_wbls)->get();
                                    
                                    return $files->map(function ($file) {
                                        $question = TrQuestion::find($file->i_id_question);
                                        $fileCategory = \Illuminate\Support\Facades\DB::table('trwblsfilecateg')
                                            ->where('c_wbls_filecateg', $file->c_wbls_filecateg)
                                            ->value('n_wbls_filecateg');
                                        
                                        return [
                                            'pertanyaan' => $question?->n_question ?? 'Pertanyaan tidak ditemukan',
                                            'nama_file' => $file->n_wbls_file,
                                            'kategori' => $fileCategory ?? 'Tidak ada kategori',
                                            'tanggal' => $file->d_wbls_file,
                                            'url_download' => $file->n_wbls_file,
                                        ];
                                    });
                                })
                                ->schema([
                                    TextEntry::make('pertanyaan')
                                        ->label('Pertanyaan')
                                        ->columnSpanFull(),

                                    TextEntry::make('kategori')
                                        ->label('Kategori')
                                        ->columnSpan(1),

                                    Actions::make([
                                        Action::make('download')
                                            ->label('Download')
                                            ->icon('heroicon-o-arrow-down-tray')
                                            ->color('primary')
                                            ->link()
                                            ->url(function ($record) {
                                                $filename = data_get($record, 'url_download');
                                                if (!$filename) {
                                                    return null;
                                                }
                                                return route('wbs.download', ['filename' => $filename]);
                                            }),
                                    ])
                                    ->columnSpanFull(),
                                ])
                                ->visible(function (Tmwbls $record) {
                                    return TmwblsFile::where('i_wbls', $record->i_wbls)->exists();
                                }),

                            TextEntry::make('kosong')
                                ->label('')
                                ->state('Tidak ada file')
                                ->columnSpanFull()
                                ->visible(function (Tmwbls $record) {
                                    return !TmwblsFile::where('i_wbls', $record->i_wbls)->exists();
                                }),
                        ]),
                ]),
        ]);
    }
}