<?php

namespace App\Filament\Resources\CaraMelapors\Pages;

use App\Filament\Resources\CaraMelapors\CaraMelaporResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCaraMelapors extends ListRecords
{
    protected static string $resource = CaraMelaporResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah'),
        ];
    }
}
