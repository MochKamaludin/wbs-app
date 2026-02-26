<?php

namespace App\Filament\Resources\RekapData\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\WblsExport;
use Filament\Actions\Action;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;


class RekapDataTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->headerActions([
                Action::make('exportExcel')
                    ->label('Export Excel')
                    ->color('success')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(function ($livewire) {
                        $query = $livewire->getFilteredTableQuery();

                        return Excel::download(
                            new WblsExport($query),
                            'laporan-wbls.xlsx'
                        );
                    }),

                    Action::make('exportPdf')
                    ->label('Export PDF')
                    ->color('danger')
                    ->icon('heroicon-o-document-arrow-down')
                    ->action(function ($livewire) {

                        $data = $livewire
                            ->getFilteredTableQuery()
                            ->get();

                        $pdf = Pdf::loadView('pdf.wbls', [
                            'data' => $data,
                        ]);

                        return response()->streamDownload(
                            fn () => print($pdf->output()),
                            'laporan-wbls.pdf'
                        );
                    }),
            ])
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
                
                TextColumn::make('status.e_wbls_stat')
                    ->label('Status Proses')
                    ->html(),
                
                TextColumn::make('e_wbls_stat')
                    ->label('Keterangan'),

            ])
            ->filters([
            SelectFilter::make('status_group')
                ->label('Status Pengaduan')
                ->options([
                    'all'   => 'Semua',
                    'open'  => 'Open',
                    'close' => 'Close',
                ])
                ->default('all')
                ->query(function (Builder $query, array $data) {

                    $value = $data['value'] ?? null;

                    if ($value === 'open') {
                        $query->whereIn('c_wbls_stat', [1, 2, 4]);
                    }

                    if ($value === 'close') {
                        $query->whereIn('c_wbls_stat', [3, 5, 6]);
                    }

                    return $query;
                }),

            Filter::make('i_wbls')
                ->schema([
                    TextInput::make('value')
                        ->label('No WBS')
                        ->placeholder('Masukkan No WBS')
                ])
                ->query(function (Builder $query, array $data) {

                    if (!empty($data['value'])) {
                        $query->where('i_wbls', 'like', '%' . $data['value'] . '%');
                    }

                    return $query;
                }),

            Filter::make('waktu')
                ->schema([

                    Select::make('jenis_waktu')
                        ->label('Filter Berdasarkan')
                        ->options([
                            'periode' => 'Periode',
                            'tahun'   => 'Tahun',
                        ])
                        ->reactive(),

                    DatePicker::make('tanggal_awal')
                        ->visible(fn ($get) => $get('jenis_waktu') === 'periode'),

                    DatePicker::make('tanggal_akhir')
                        ->visible(fn ($get) => $get('jenis_waktu') === 'periode'),

                    Select::make('tahun')
                        ->options(function () {
                            $year = now()->year;
                            return collect(range($year, $year - 5))
                                ->mapWithKeys(fn ($y) => [$y => $y])
                                ->toArray();
                        })
                        ->visible(fn ($get) => $get('jenis_waktu') === 'tahun'),
                ])
                ->query(function (Builder $query, array $data) {

                    if (($data['jenis_waktu'] ?? null) === 'periode') {

                        $query->when(
                            $data['tanggal_awal'] ?? null,
                            fn ($q, $date) => $q->whereDate('d_wbls', '>=', $date)
                        );

                        $query->when(
                            $data['tanggal_akhir'] ?? null,
                            fn ($q, $date) => $q->whereDate('d_wbls', '<=', $date)
                        );
                    }

                    if (($data['jenis_waktu'] ?? null) === 'tahun' && !empty($data['tahun'])) {
                        $query->whereYear('d_wbls', $data['tahun']);
                    }

                    return $query;
                }),

        ], layout: FiltersLayout::AboveContent)

            ->recordActions([
                ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
