<?php

namespace App\Filament\Resources\CaraMelapors\Pages;

use App\Filament\Resources\CaraMelapors\CaraMelaporResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCaraMelapor extends ViewRecord
{
    protected static string $resource = CaraMelaporResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
