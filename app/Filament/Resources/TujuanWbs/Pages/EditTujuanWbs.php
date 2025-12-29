<?php

namespace App\Filament\Resources\TujuanWbs\Pages;

use App\Filament\Resources\TujuanWbs\TujuanWbsResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Facades\Filament;

class EditTujuanWbs extends EditRecord
{
    protected static string $resource = TujuanWbsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $user = Filament::auth()->user();

        $data['i_wbls_adm'] = $user->i_wbls_adm; // ✅ BENAR
        $data['d_wbls_purpose'] = now();
        $data['f_wbls_purposestat'] = (string) ($data['f_wbls_purposestat'] ?? '0');

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
