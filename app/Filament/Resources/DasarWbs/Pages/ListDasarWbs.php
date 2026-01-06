<?php

namespace App\Filament\Resources\DasarWbs\Pages;

use App\Filament\Resources\DasarWbs\DasarWbsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Models\DefinisiWbs;

class ListDasarWbs extends ListRecords
{
    protected static string $resource = DasarWbsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
            ->label('Tambah')
                ->visible(fn() => DefinisiWbs::where('i_wbls_about', '3')->count() === 0),
        ];
    }
}
