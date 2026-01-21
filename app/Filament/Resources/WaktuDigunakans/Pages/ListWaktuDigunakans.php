<?php

namespace App\Filament\Resources\WaktuDigunakans\Pages;

use App\Filament\Resources\WaktuDigunakans\WaktuDigunakanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Models\DefinisiWbs;

class ListWaktuDigunakans extends ListRecords
{
    protected static string $resource = WaktuDigunakanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah')
                ->visible(fn() => DefinisiWbs::where('i_wbls_about', '2')->count() === 0),
        ];
    }
}
