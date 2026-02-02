<?php

namespace App\Filament\Widgets;

use App\Models\CaraMelapor;
use App\Models\ReferensiKategori;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use \App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Icons\Heroicon;

class StatWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            // Stat::make("Total Pengguna", User::count())
            //     ->description("Total Pengguna Tahun Ini")
            //     ->descriptionIcon(Heroicon::ArrowUpLeft, IconPosition::Before)
            //     ->descriptionColor("success")
            //     ->color("success"),
            // Stat::make("Kategori", ReferensiKategori::count())
            //     ->description("Jumlah Kategori Pelanggaran")
            //     ->descriptionIcon(Heroicon::ArrowUpLeft, IconPosition::Before)
            //     ->descriptionColor("warning")
            //     ->color("warning")
        ];
    }
}
