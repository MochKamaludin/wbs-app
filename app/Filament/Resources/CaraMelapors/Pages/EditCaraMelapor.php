<?php

namespace App\Filament\Resources\CaraMelapors\Pages;

use App\Filament\Resources\CaraMelapors\CaraMelaporResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Facades\Filament;

class EditCaraMelapor extends EditRecord
{
    protected static string $resource = CaraMelaporResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = Filament::auth()->user();

        $data['i_wbls_adm'] = $user->i_wbls_adm ?? 'system';
        $data['d_wbls_proc'] = now();
        $data['f_wbls_procstat'] = $data['f_wbls_procstat'] ? '1' : '0';

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
