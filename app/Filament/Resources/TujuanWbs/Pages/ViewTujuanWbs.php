<?php

namespace App\Filament\Resources\TujuanWbs\Pages;

use App\Filament\Resources\TujuanWbs\TujuanWbsResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTujuanWbs extends ViewRecord
{
    protected static string $resource = TujuanWbsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
