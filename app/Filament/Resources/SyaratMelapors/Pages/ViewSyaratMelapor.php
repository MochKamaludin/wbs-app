<?php

namespace App\Filament\Resources\SyaratMelapors\Pages;

use App\Filament\Resources\SyaratMelapors\SyaratMelaporResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSyaratMelapor extends ViewRecord
{
    protected static string $resource = SyaratMelaporResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
