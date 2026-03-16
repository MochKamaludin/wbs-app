<?php

namespace App\Filament\Widgets;

use App\Models\Pengaduan;
use Filament\Widgets\ChartWidget as BaseChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class ChartWidget extends BaseChartWidget
{
    protected ?string $heading = 'Laporan Diterima';

    protected string $color = 'info';

    protected function getData(): array
    {
        $data = Trend::model(Pengaduan::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->dateColumn('d_entry')
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Laporan',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate)->toArray(),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
