<?php

namespace App\Filament\Resources\WbsVerifications\Pages;

use App\Filament\Resources\WbsVerifications\WbsVerificationResource;
use App\Models\Verification;
use App\Services\BaVerifikasiService;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditWbsVerification extends EditRecord    {
    protected static string $resource = WbsVerificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}