<?php

namespace App\Filament\Resources\SyaratMelapors\Pages;

use App\Filament\Resources\SyaratMelapors\SyaratMelaporResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSyaratMelapor extends EditRecord
{
    protected static string $resource = SyaratMelaporResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $user = \Filament\Facades\Filament::auth()->user();

        $data['i_wbls_adm'] = $user->i_wbls_adm;
        $data['d_entry'] = now();
        $data['f_wbls_reqstat'] = $data['f_wbls_reqstat'] ? '1' : '0';

        return $data;
    }

}
