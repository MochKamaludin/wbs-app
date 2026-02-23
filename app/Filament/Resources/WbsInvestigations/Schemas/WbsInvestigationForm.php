<?php

namespace App\Filament\Resources\WbsInvestigations\Schemas;

use App\Models\ReferensiStatus;
use App\Models\TmAnswer;
use App\Models\Tmwbls;
use App\Models\TmwblsFile;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Grid;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;

class WbsInvestigationForm
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
                            ->placeholder('-')
                            ->html(),
                    ]),
                ]),

                    Group::make()
                        ->relationship('investigation')
                        ->schema([
                        Textarea::make('e_wbls_resume')
                                ->label('Keterangan Resume')
                                ->nullable()
                                ->dehydrated(true)
                    ]),
            
                        Select::make('c_wbls_stat')
                            ->label('Status Laporan')
                            ->required()
                            ->options(
                                ReferensiStatus::whereIn('c_wbls_stat', ['3', '5', '6'])
                                    ->pluck('n_wbls_stat', 'c_wbls_stat')
                            ),
        ]);
    }
}
