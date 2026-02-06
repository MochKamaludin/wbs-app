<?php

namespace App\Filament\Widgets;

use App\Models\CaraMelapor;
use App\Models\ReferensiKategori;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use \App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Icons\Heroicon;
use App\Models\Tmwbls;

class StatWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Laporan', Tmwbls::count())
                ->description('Semua laporan')
                ->icon('heroicon-o-clipboard-document')
                ->color('gray'),

            Stat::make(
                'Laporan Terverifikasi',
                Tmwbls::where('f_wbls_agree', 1)->count()
            )
                ->description('Sudah diverifikasi')
                ->icon('heroicon-o-check-badge')
                ->color('warning'),

            Stat::make(
                'Laporan Selesai',
                Tmwbls::where('c_wbls_stat', 5)->count()
            )
                ->description('Proses selesai')
                ->icon('heroicon-o-check-circle')
                ->color('success'),
        ];
    }
}
