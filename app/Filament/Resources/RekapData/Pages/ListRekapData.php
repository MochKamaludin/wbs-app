<?php

namespace App\Filament\Resources\RekapData\Pages;

use App\Filament\Resources\RekapData\RekapDataResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRekapData extends ListRecords
{
    protected static string $resource = RekapDataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
