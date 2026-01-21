<?php

namespace App\Filament\Resources\WaktuDigunakans\Pages;

use App\Filament\Resources\WaktuDigunakans\WaktuDigunakanResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Facades\Filament;

class EditWaktuDigunakan extends EditRecord
{
    protected static string $resource = WaktuDigunakanResource::class;
    protected static ?string $title = 'Edit';
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

        $data['i_wbls_adm'] = $user?->i_wbls_adm ?? 'system';
        $data['d_wbls_about'] = now();

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
