<?php

namespace App\Filament\Resources\ReferensiKategoris\Pages;

use App\Filament\Resources\ReferensiKategoris\ReferensiKategoriResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditReferensiKategori extends EditRecord
{
    protected static string $resource = ReferensiKategoriResource::class;

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
