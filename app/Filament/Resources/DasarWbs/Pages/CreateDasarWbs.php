<?php

namespace App\Filament\Resources\DasarWbs\Pages;

use App\Filament\Resources\DasarWbs\DasarWbsResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Facades\Filament;
use App\Models\DefinisiWbs;

class CreateDasarWbs extends CreateRecord
{
    protected static string $resource = DasarWbsResource::class;

    protected static ?string $title = 'Tambah';

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

    protected function authorizeAccess(): void
    {
        abort_if(DefinisiWbs::where('i_wbls_about', '3')->count() > 0, 403);
    }
}
