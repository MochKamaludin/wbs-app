<?php

namespace App\Filament\Resources\WbsVerifications\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Group;

class WbsVerificationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Data Pengaduan')
                    ->schema([

                        TextEntry::make('i_wbls')
                            ->label('No. WBS')
                            ->columnSpanFull(),

                        TextEntry::make('kategori.n_wbls_categ')
                            ->label('Perihal')
                            ->columnSpanFull(),

                        TextEntry::make('e_wbls')
                            ->label('Uraian')
                            ->columnSpanFull(),

                        TextEntry::make('d_wbls')
                            ->label('Tanggal Pelaporan')
                            ->dateTime('d M Y')
                            ->columnSpanFull(),

                        TextEntry::make('d_wbls_incident')
                            ->label('Perkiraan Waktu Kejadian')
                            ->dateTime('d M Y')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Hasil Verifikasi')
                    ->schema([

                        Radio::make('f_wbls_usrname')
                            ->label('Identitas Pelapor')
                            ->options([
                                '1' => 'Ada',
                                '0' => 'Tidak Ada / Anonim',
                            ])
                            ->required()
                            ->inline(),

                        Radio::make('f_wbls_file')
                            ->label('Bukti Dokumen')
                            ->options([
                                '1' => 'Lengkap',
                                '2' => 'Tidak Lengkap',
                                '3' => 'Tidak Ada',
                            ])
                            ->required()
                            ->inline(),
                        
                        TextArea::make('e_wbls_stat')
                            ->label('Keterangan')
                            ->nullable()
                            ->dehydrated(true)
                    ])
                    ->columns(1),
            ]);
    }
}