<?php

namespace App\Filament\Resources\ReferensiKategoris\Pages;

use App\Filament\Resources\ReferensiKategoris\ReferensiKategoriResource;
use Filament\Resources\Pages\CreateRecord;

class CreateReferensiKategori extends CreateRecord
{
    protected static string $resource = ReferensiKategoriResource::class;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
