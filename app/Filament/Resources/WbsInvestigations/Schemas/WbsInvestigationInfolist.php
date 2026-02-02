<?php

namespace App\Filament\Resources\WbsInvestigations\Schemas;

use Filament\Schemas\Schema;
use App\Models\TmAnswer;
use App\Models\Tmwbls;
use App\Models\TmwblsFile;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Grid;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Schemas\Components\Section;

class WbsInvestigationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make()
                ->schema([
                    Grid::make(1)->schema([

                        Grid::make(2)->schema([
                            TextEntry::make('i_wbls')
                                ->label('Nomor WBS'),

                            TextEntry::make('kategori.n_wbls_categ')
                                ->label('Kategori'),

                            TextEntry::make('d_wbls')
                                ->label('Tanggal Lapor')
                                ->dateTime('d/m/Y H:i'),

                            TextEntry::make('d_wbls_incident')
                                ->label('Perkiraan Waktu Kejadian'),
                        ]),

                        TextEntry::make('e_wbls')
                            ->label('Uraian Kejadian'),

                        TextEntry::make('e_wbls_stat')
                            ->label('Keterangan Status')
                            ->html(),
                    ]),
                ]),

            Group::make()
                ->schema([
                    Grid::make(2)->schema([
                        RepeatableEntry::make('answers')
                            ->label('Jawaban Pertanyaan')
                            ->state(fn (Tmwbls $record) =>
                                TmAnswer::where('i_wbls', $record->i_wbls)->get()
                            )
                            ->schema([
                                TextEntry::make('pertanyaan.n_question')
                                    ->label('Pertanyaan'),

                                TextEntry::make('e_answer')
                                    ->label('Jawaban'),
                            ]),

                        RepeatableEntry::make('files')
                            ->label('Lampiran')
                            ->state(fn (Tmwbls $record) =>
                                TmwblsFile::where('i_wbls', $record->i_wbls)->get()
                            )
                            ->schema([
                                TextEntry::make('n_wbls_file')
                                    ->label('Nama File'),

                                TextEntry::make('category.n_wbls_filecateg')
                                    ->label('Kategori File'),

                                TextEntry::make('d_wbls_file')
                                    ->label('Tanggal Upload')
                                    ->dateTime('d/m/Y H:i'),

                                TextEntry::make('download')
                                    ->label('Aksi')
                                    ->state('Download')
                                    ->url(fn ($record) => $record->download_url)
                                    ->openUrlInNewTab()
                                    ->icon('heroicon-o-arrow-down-tray')
                                    ->color('primary'),
                            ]),
                    ]),
                ]),
        ]);
    }
}