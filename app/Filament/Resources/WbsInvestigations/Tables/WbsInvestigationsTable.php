<?php

namespace App\Filament\Resources\WbsInvestigations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use App\Models\Tmwbls;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder; 
use Illuminate\Support\Facades\DB;
use App\Services\BeritaAcaraService;
use Filament\Actions\Action;

class WbsInvestigationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('i_wbls')
                    ->label('Nomor WBS')
                    ->searchable(),
                
                TextColumn::make('d_wbls')
                    ->label('Tanggal Pengaduan')
                    ->dateTime('d M Y'),

                TextColumn::make('kategori.n_wbls_categ')
                    ->label('Perihal')
                    ->searchable(),
                
                TextColumn::make('e_wbls_stat')
                    ->label('Keterangan'),
            ])
            ->filters([
                SelectFilter::make('c_wbls_stat')
                ->label('Status')
                ->options([
                    3 => 'Laporan Ditolak', 
                    4 => 'Dalam Pemeriksaan',
                    5 => 'Selesai dan Terlapor Bersalah',
                    6 => 'Selesai dan Terlapor Tidak Terbukti Bersalah',
                ]),

                Filter::make('waktu')
                ->label('Waktu')
                ->schema([
                    DatePicker::make('tanggal_awal')
                        ->label('Tanggal Awal'),
                    DatePicker::make('tanggal_akhir')
                        ->label('Tanggal Akhir'),
                ])
                ->query(function (Builder $query, array $data) {
                    return $query
                        ->when($data['tanggal_awal'], fn ($q) =>
                            $q->whereDate('d_wbls', '>=', $data['tanggal_awal'])
                        )
                        ->when($data['tanggal_akhir'], fn ($q) =>
                            $q->whereDate('d_wbls', '<=', $data['tanggal_akhir'])
                        );
                }),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make()
                    ->visible(fn (Tmwbls $record) => ! in_array($record->c_wbls_stat, [3, 5, 6])),

                Action::make('generateBA')
                    ->label('Generate BA Investigasi')
                    ->color('success')
                    ->visible(fn (Tmwbls $record) => in_array($record->c_wbls_stat, [3, 5, 6]))
                    ->url(function (Tmwbls $record) {

                        $resume = \App\Models\Investigation::firstOrCreate([
                            'i_wbls' => $record->i_wbls
                        ]);

                        return route('ba.investigasi.pdf', $resume->id);
                    })
                    ->openUrlInNewTab(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
