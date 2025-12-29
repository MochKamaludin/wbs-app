<?php

namespace App\Filament\Resources\TujuanWbs\Pages;

use App\Filament\Resources\TujuanWbs\TujuanWbsResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Facades\Filament;

class CreateTujuanWbs extends CreateRecord
{
    protected static string $resource = TujuanWbsResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = Filament::auth()->user();

        $data['i_wbls_adm'] = $user->i_wbls_adm;
        $data['d_wbls_purpose'] = now();
        $data['f_wbls_purposestat'] = (string) ($data['f_wbls_purposestat'] ?? '0');

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
