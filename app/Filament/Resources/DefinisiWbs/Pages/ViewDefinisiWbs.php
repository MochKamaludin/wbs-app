<?php

namespace App\Filament\Resources\DefinisiWbs\Pages;

use App\Filament\Resources\DefinisiWbs\DefinisiWbsResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDefinisiWbs extends ViewRecord
{
    protected static string $resource = DefinisiWbsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
