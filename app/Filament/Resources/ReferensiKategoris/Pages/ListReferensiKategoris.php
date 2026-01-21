<?php

namespace App\Filament\Resources\ReferensiKategoris\Pages;

use App\Filament\Resources\ReferensiKategoris\ReferensiKategoriResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListReferensiKategoris extends ListRecords
{
    protected static string $resource = ReferensiKategoriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Referensi Kategori'),
        ];
    }
}
