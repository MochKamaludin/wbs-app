<?php

namespace App\Filament\Resources\TujuanWbs\Pages;

use App\Filament\Resources\TujuanWbs\TujuanWbsResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Storage;

class CreateTujuanWbs extends CreateRecord
{
    protected static string $resource = TujuanWbsResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = Filament::auth()->user();

        $data['i_wbls_adm'] = $user->i_wbls_adm;
        $data['d_wbls_purpose'] = now();
        $data['f_wbls_purposestat'] = $data['f_wbls_purposestat'] ? '1' : '0';

        return $data;
    }


    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }

    protected function afterCreate(): void
{
    $state = $this->form->getRawState();
    $record = $this->record;

    if (empty($state['icon_temp'])) {
        return;
    }

    // normalize path
    $from = is_array($state['icon_temp'])
        ? $state['icon_temp'][0] ?? null
        : $state['icon_temp'];

    if (!$from) {
        return;
    }

    $to = "images/tujuan/tujuan_{$record->c_wbls_purposeord}.png";

    if (Storage::disk('public')->exists($from)) {
        Storage::disk('public')->move($from, $to);
    }
}


}
