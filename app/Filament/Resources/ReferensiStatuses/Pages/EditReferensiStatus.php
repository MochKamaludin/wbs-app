<?php

namespace App\Filament\Resources\ReferensiStatuses\Pages;

use App\Filament\Resources\ReferensiStatuses\ReferensiStatusResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditReferensiStatus extends EditRecord
{
    protected static string $resource = ReferensiStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
