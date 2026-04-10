<?php

namespace App\Filament\Widgets;

use App\Models\Pengaduan;
use Filament\Widgets\ChartWidget as BaseChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Carbon\Carbon;

class ChartWidget extends BaseChartWidget
{
    public ?string $filter = null;

    public function mount(): void
    {
        $this->filter = (string) now()->year;
    }

    protected function getFilters(): ?array
    {
        $years = range(now()->year - 3, now()->year);

        return collect($years)
            ->mapWithKeys(fn ($year) => [(string) $year => (string) $year])
            ->toArray();
    }

     public function getHeading(): ?string
    {
        return 'Pengaduan Tahun ' . ($this->filter ?? now()->year);
    }


    protected function getData(): array
    {
        $year = (int) ($this->filter ?? now()->year);

        $start = Carbon::create($year)->startOfYear();
        $end   = Carbon::create($year)->endOfYear();

        $total = Trend::model(Pengaduan::class)
            ->between(start: $start, end: $end)
            ->perMonth()
            ->dateColumn('d_entry')
            ->count();

        $verifikasi = Trend::query(
            Pengaduan::query()
                ->where('c_wbls_stat', 4)
                ->where('f_wbls_agree', 1)
        )
            ->between(start: $start, end: $end)
            ->perMonth()
            ->dateColumn('d_entry')
            ->count();

        $selesai = Trend::query(
            Pengaduan::query()
                ->whereIn('c_wbls_stat', [3, 5, 6])
        )
            ->between(start: $start, end: $end)
            ->perMonth()
            ->dateColumn('d_entry')
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Total Laporan',
                    'data' => $total->map(fn (TrendValue $value) => $value->aggregate),
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59,130,246,0.2)',
                ],
                [
                    'label' => 'Terverifikasi',
                    'data' => $verifikasi->map(fn (TrendValue $value) => $value->aggregate),
                    'borderColor' => '#f59e0b',
                    'backgroundColor' => 'rgba(245,158,11,0.2)',
                ],
                [
                    'label' => 'Selesai',
                    'data' => $selesai->map(fn (TrendValue $value) => $value->aggregate),
                    'borderColor' => '#10b981',
                    'backgroundColor' => 'rgba(16,185,129,0.2)',
                ],
            ],

            'labels' => $total->map(function (TrendValue $value) {
                return Carbon::parse($value->date)->translatedFormat('M');
            }),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}