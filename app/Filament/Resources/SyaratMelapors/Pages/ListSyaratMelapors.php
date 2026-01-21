<?php

namespace App\Filament\Resources\SyaratMelapors\Pages;

use App\Filament\Resources\SyaratMelapors\SyaratMelaporResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSyaratMelapors extends ListRecords
{
    protected static string $resource = SyaratMelaporResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Syarat Melapor'),
        ];
    }
}
