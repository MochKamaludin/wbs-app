<?php

namespace App\Filament\Resources\TrQuestions\Pages;

use App\Filament\Resources\TrQuestions\TrQuestionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTrQuestions extends ListRecords
{
    protected static string $resource = TrQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah'),
        ];
    }
}
