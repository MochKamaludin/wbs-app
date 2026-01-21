<?php

namespace App\Filament\Resources\DasarWbs\Pages;

use App\Filament\Resources\DasarWbs\DasarWbsResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDasarWbs extends ViewRecord
{
    protected static string $resource = DasarWbsResource::class;

    protected static ?string $title = 'View Dasar WBS';
    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
