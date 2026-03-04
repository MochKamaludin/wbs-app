<?php

namespace App\Filament\Resources\Ketentuans\Pages;

use App\Filament\Resources\Ketentuans\KetentuanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Models\DefinisiWbs;

class ListKetentuans extends ListRecords
{
    protected static string $resource = KetentuanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Buat')
                ->visible(fn () => 
                    ! DefinisiWbs::where('i_wbls_about', 4)->exists()
                ),
        ];
    }
}
