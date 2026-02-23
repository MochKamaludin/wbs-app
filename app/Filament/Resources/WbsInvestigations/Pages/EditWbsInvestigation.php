<?php

namespace App\Filament\Resources\WbsInvestigations\Pages;

use App\Filament\Resources\WbsInvestigations\WbsInvestigationResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use App\Models\ReferensiStatus;
use Illuminate\Support\Facades\Auth;



class EditWbsInvestigation extends EditRecord
{
    protected static string $resource = WbsInvestigationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return $data;
    }
}
