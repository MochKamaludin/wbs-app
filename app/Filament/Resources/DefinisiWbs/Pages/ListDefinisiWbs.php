<?php

namespace App\Filament\Resources\DefinisiWbs\Pages;

use App\Filament\Resources\DefinisiWbs\DefinisiWbsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDefinisiWbs extends ListRecords
{
    protected static string $resource = DefinisiWbsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
