<?php

namespace App\Filament\Resources\PerlindunganPelapors\Pages;

use App\Filament\Resources\PerlindunganPelapors\PerlindunganPelaporResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPerlindunganPelapor extends ViewRecord
{
    protected static string $resource = PerlindunganPelaporResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
