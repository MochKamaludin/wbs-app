<?php

namespace App\Filament\Resources\ReferensiStatuses\Pages;

use App\Filament\Resources\ReferensiStatuses\ReferensiStatusResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListReferensiStatuses extends ListRecords
{
    protected static string $resource = ReferensiStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Referensi Status'),
        ];
    }
}
