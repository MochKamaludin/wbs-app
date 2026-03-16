<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class DoughnutChartWidget extends ChartWidget
{
    protected ?string $heading = 'Kategori Laporan Diterima';

    protected function getData(): array
    {
        $data = DB::table('tmwbls')
            ->join('trwblscateg', 'tmwbls.c_wbls_categ', '=', 'trwblscateg.c_wbls_categ')
            ->select('trwblscateg.n_wbls_categ', DB::raw('count(*) as total'))
            ->groupBy('trwblscateg.n_wbls_categ')
            ->get();

        $labels = $data->pluck('n_wbls_categ');
        $values = $data->pluck('total');

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Laporan',
                    'data' => $values,
                    'backgroundColor' => [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0',
                        '#9966FF',
                        '#FF9F40',
                        '#E7E9ED',
                        '#FF6384',
                    ],
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}