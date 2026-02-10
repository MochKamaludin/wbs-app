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
            ->query(fn () => Tmwbls::query()->where('f_wbls_agree', '1')
                                            ->where('c_wbls_stat', '4'))
            ->columns([
                TextColumn::make('i_wbls')
                    ->label('Nomor WBS')
                    ->searchable(),

                TextColumn::make('kategori.n_wbls_categ')
                    ->label('Kategori'),

                TextColumn::make('d_wbls')
                    ->label('Tanggal Lapor')
                    ->dateTime('d/m/Y H:i'),

                TextColumn::make('status.n_wbls_stat')
                    ->label('Status')
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
                EditAction::make(),

                Action::make('generateBA')
                    ->label('Generate BA')
                    ->color('success')
                    ->action(function (Tmwbls $record) {
                        BeritaAcaraService::generateAndUpdate($record);

                        return redirect()->route('ba.pdf', $record->resume);
                    })
                    ->openUrlInNewTab()
                ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
