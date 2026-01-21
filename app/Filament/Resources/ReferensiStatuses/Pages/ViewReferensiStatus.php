<?php

namespace App\Filament\Resources\ReferensiStatuses\Pages;

use App\Filament\Resources\ReferensiStatuses\ReferensiStatusResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewReferensiStatus extends ViewRecord
{
    protected static string $resource = ReferensiStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
