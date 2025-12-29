<?php

namespace App\Filament\Resources\DefinisiWbs\Pages;

use App\Filament\Resources\DefinisiWbs\DefinisiWbsResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Facades\Filament;

class CreateDefinisiWbs extends CreateRecord
{
    protected static string $resource = DefinisiWbsResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = Filament::auth()->user();

        $data['i_wbls_adm'] = $user?->i_wbls_adm ?? 'system';
        $data['d_wbls_about'] = now();

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
