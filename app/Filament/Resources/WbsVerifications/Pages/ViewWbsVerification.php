<?php

namespace App\Filament\Resources\WbsVerifications\Pages;

use App\Filament\Resources\WbsVerifications\WbsVerificationResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewWbsVerification extends ViewRecord
{
    protected static string $resource = WbsVerificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
