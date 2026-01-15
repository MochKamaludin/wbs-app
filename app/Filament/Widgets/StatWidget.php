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
            Stat::make("Total Pengguna", User::count())
                ->description("Total Pengguna Tahun Ini")
                ->descriptionIcon(Heroicon::ArrowDownLeft, IconPosition::Before)
                ->chart([
                    2,4,6,7,12,15,17
                ])
                ->descriptionColor("success")
                ->color("success"),
            Stat::make("Cara Melapor", CaraMelapor::count())
                ->description("Langkah-langkah melapor")
                ->descriptionIcon(Heroicon::ArrowDownLeft, IconPosition::Before)
                ->chart([
                    1,4,6,8,10,70
                ])
                ->descriptionColor("info")
                ->color("info"),
            Stat::make("Kategori", ReferensiKategori::count())
                ->description("Jumlah Kategori Pelanggaran")
                ->descriptionIcon(Heroicon::ArrowDownLeft, IconPosition::Before)
                ->chart([
                    54,34,23,3,4,7,1
                ])
                ->descriptionColor("warning")
                ->color("warning")
        ];
    }
}
