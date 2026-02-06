<?php

namespace App\Filament\Resources\RekapData\Tables;

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
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\WblsExport;
use Filament\Actions\Action;
use Barryvdh\DomPDF\Facade\Pdf;

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

            ->query(fn () => Tmwbls::query()->where('f_wbls_agree', '1')->whereIn('c_wbls_stat', ['3', '5', '6']))
            ->columns([
                TextColumn::make('i_wbls')
                    ->label('Nomor WBS')
                    ->searchable(),

                TextColumn::make('kategori.n_wbls_categ')
                    ->label('Kategori')
                    ->searchable(),

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
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
