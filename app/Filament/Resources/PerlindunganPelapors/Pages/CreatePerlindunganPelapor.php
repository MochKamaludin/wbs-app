<?php

namespace App\Filament\Resources\PerlindunganPelapors\Pages;

use App\Filament\Resources\PerlindunganPelapors\PerlindunganPelaporResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Facades\Filament;

class CreatePerlindunganPelapor extends CreateRecord
{
    protected static string $resource = PerlindunganPelaporResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = Filament::auth()->user();

        $data['i_wbls_adm'] = $user->i_wbls_adm;
        $data['d_wbls_protect'] = now();
        $data['f_wbls_protectstat'] = $data['f_wbls_protectstat'] ? '1' : '0';
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
