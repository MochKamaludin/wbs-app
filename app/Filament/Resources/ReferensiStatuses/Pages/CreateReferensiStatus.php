<?php

namespace App\Filament\Resources\ReferensiStatuses\Pages;

use App\Filament\Resources\ReferensiStatuses\ReferensiStatusResource;
use Filament\Resources\Pages\CreateRecord;

class CreateReferensiStatus extends CreateRecord
{
    protected static string $resource = ReferensiStatusResource::class;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
