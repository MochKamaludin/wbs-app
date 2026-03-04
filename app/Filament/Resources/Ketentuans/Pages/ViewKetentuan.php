<?php

namespace App\Filament\Resources\Ketentuans\Pages;

use App\Filament\Resources\Ketentuans\KetentuanResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewKetentuan extends ViewRecord
{
    protected static string $resource = KetentuanResource::class;
    protected static ?string $title = 'View Ketentuan & Kebijakan';
    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
