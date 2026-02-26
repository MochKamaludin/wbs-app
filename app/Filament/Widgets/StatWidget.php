<?php

namespace App\Filament\Widgets;

use App\Models\Pengaduan;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Laporan', Pengaduan::count())
                ->description('Semua laporan')
                ->icon('heroicon-o-clipboard-document')
                ->color('gray'),

            Stat::make(
                'Laporan Terverifikasi',
                Pengaduan::where('f_wbls_agree', 1)->count()
            )
                ->description('Sudah diverifikasi')
                ->icon('heroicon-o-check-badge')
                ->color('warning'),

            Stat::make(
                'Laporan Selesai',
                Pengaduan::where('c_wbls_stat', 5)->count()
            )
                ->description('Proses selesai')
                ->icon('heroicon-o-check-circle')
                ->color('success'),
        ];
    }
}
