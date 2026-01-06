<?php

namespace App\Filament\Resources\ReferensiKategoris\Pages;

use App\Filament\Resources\ReferensiKategoris\ReferensiKategoriResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewReferensiKategori extends ViewRecord
{
    protected static string $resource = ReferensiKategoriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
