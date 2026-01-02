<?php

namespace App\Filament\Resources\PerlindunganPelapors\Pages;

use App\Filament\Resources\PerlindunganPelapors\PerlindunganPelaporResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPerlindunganPelapors extends ListRecords
{
    protected static string $resource = PerlindunganPelaporResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Perlindungan Pelapor'),
        ];
    }
}
