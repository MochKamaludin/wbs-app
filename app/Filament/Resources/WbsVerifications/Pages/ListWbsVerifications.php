<?php

namespace App\Filament\Resources\WbsVerifications\Pages;

use App\Filament\Resources\WbsVerifications\WbsVerificationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListWbsVerifications extends ListRecords
{
    protected static string $resource = WbsVerificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
        //    'new' => Tab::make()->query(fn ($query) => $query->where('status', 'new')),
            'baru' => Tab::make()->query(fn ($query) => $query->whereNull('f_wbls_agree')),
            'disetujui' => Tab::make()->query(fn ($query) => $query->where('f_wbls_agree', '1')),
        ];
    }
}
