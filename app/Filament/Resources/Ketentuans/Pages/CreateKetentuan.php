<?php

namespace App\Filament\Resources\Ketentuans\Pages;

use App\Filament\Resources\Ketentuans\KetentuanResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Facades\Filament;
use App\Models\DefinisiWbs;

class CreateKetentuan extends CreateRecord
{
    protected static string $resource = KetentuanResource::class;

    protected static ?string $title = 'Buat Ketentuan & Kebijakan';

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
        abort_if(
            DefinisiWbs::where('i_wbls_about', 4)->exists(),
            403
        );
    }
}
