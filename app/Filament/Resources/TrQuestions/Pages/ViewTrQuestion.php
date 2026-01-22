<?php

namespace App\Filament\Resources\TrQuestions\Pages;

use App\Filament\Resources\TrQuestions\TrQuestionResource;
use Illuminate\Support\Facades\DB;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions\EditAction;

class ViewTrQuestion extends ViewRecord
{
    protected static string $resource = TrQuestionResource::class;
    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return 'Detail Pertanyaan';
    }

    protected function mutateRecordDataBeforeFill(array $data): array
    {
        $data['choices'] = DB::table('trquestionchoice')
            ->where('i_id_question', $this->record->i_id_question)
            ->orderBy('i_choice_sort')
            ->get()
            ->map(fn ($item) => [
                'i_choice_sort' => $item->i_choice_sort,
                'n_choice'      => $item->n_choice,
                'f_active'      => (bool) $item->f_active,
            ])
            ->toArray();

        return $data;
    }
}
