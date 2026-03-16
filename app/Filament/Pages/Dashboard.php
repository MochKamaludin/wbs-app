<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ChartWidget;
use App\Filament\Widgets\DoughnutChartWidget;
use App\Filament\Widgets\StatWidget;
use Filament\Pages\Dashboard as BaseDashboard;
use BackedEnum;
use Filament\Support\Icons\Heroicon;

class Dashboard extends BaseDashboard
{
    protected string $view = 'filament.pages.dashboard';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;
    protected ?string $heading = 'Beranda';
    protected static ?string $navigationLabel = 'Beranda';

    protected function getHeaderWidgets(): array
    {
        return [
            StatWidget::class,
            ChartWidget::class,
            DoughnutChartWidget::class,
        ];
    }

}
