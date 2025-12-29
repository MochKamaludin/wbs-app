<?php

namespace App\Filament\Resources\TujuanWbs\Pages;

use App\Filament\Resources\TujuanWbs\TujuanWbsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTujuanWbs extends ListRecords
{
    protected static string $resource = TujuanWbsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
