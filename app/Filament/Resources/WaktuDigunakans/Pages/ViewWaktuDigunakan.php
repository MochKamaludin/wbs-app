<?php

namespace App\Filament\Resources\WaktuDigunakans\Pages;

use App\Filament\Resources\WaktuDigunakans\WaktuDigunakanResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewWaktuDigunakan extends ViewRecord
{
    protected static string $resource = WaktuDigunakanResource::class;
    protected static ?string $title = 'View Kapan WBS Dapat Digunakan';
    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
