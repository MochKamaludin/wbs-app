<?php

namespace App\Filament\Resources\SyaratMelapors\Pages;

use App\Filament\Resources\SyaratMelapors\SyaratMelaporResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSyaratMelapor extends CreateRecord
{
    protected static string $resource = SyaratMelaporResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = \Filament\Facades\Filament::auth()->user();

        $data['i_wbls_adm'] = $user->i_wbls_adm;
        $data['d_entry'] = now();
        $data['f_wbls_reqstat'] = $data['f_wbls_reqstat'] ? '1' : '0';

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }

}
