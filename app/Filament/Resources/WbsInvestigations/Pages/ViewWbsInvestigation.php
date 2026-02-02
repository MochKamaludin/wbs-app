<?php

namespace App\Filament\Resources\WbsInvestigations\Pages;

use App\Filament\Resources\WbsInvestigations\WbsInvestigationResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewWbsInvestigation extends ViewRecord
{
    protected static string $resource = WbsInvestigationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
