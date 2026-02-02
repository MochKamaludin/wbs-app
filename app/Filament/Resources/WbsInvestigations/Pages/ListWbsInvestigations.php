<?php

namespace App\Filament\Resources\WbsInvestigations\Pages;

use App\Filament\Resources\WbsInvestigations\WbsInvestigationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWbsInvestigations extends ListRecords
{
    protected static string $resource = WbsInvestigationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //CreateAction::make(),
        ];
    }
}
