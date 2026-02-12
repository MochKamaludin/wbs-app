<?php

namespace App\Filament\Resources\WbsInvestigations\Pages;

use App\Filament\Resources\WbsInvestigations\WbsInvestigationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;

class ListWbsInvestigations extends ListRecords
{
    protected static string $resource = WbsInvestigationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'open' => Tab::make()->query(fn ($query) => $query->whereIn('c_wbls_stat', [1,2,4])),
            'close' => Tab::make()->query(fn ($query) => $query->whereIn('c_wbls_stat', [3,5,6])),
        ];
    }
}
