<?php

namespace App\Filament\Resources\TrQuestions\Pages;

use App\Filament\Resources\TrQuestions\TrQuestionResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\DeleteAction;
use Illuminate\Support\Facades\DB;
use Filament\Facades\Filament;

class EditTrQuestion extends EditRecord
{
    protected static string $resource = TrQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return 'Edit Pertanyaan';
    }

    protected function getRedirectUrl(): string
    {
        return static::$resource::getUrl('index');
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['choices'] = DB::table('trquestionchoice')
            ->where('i_id_question', $this->record->i_id_question)
            ->orderBy('i_choice_sort')
            ->get()
            ->map(fn ($row) => [
                'i_choice_sort' => $row->i_choice_sort,
                'n_choice'      => $row->n_choice,
                'f_active'      => (bool) $row->f_active,
            ])
            ->toArray();

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        unset($data['choices']);

        $data['i_update'] = (int) Filament::auth()->user()->i_wbls_adm_id;
        $data['d_update'] = now();

        return $data;
    }

    protected function afterSave(): void
    {
        $choices = $this->form->getState()['choices'] ?? [];
        $userId = (int) Filament::auth()->user()->i_wbls_adm_id;

        DB::transaction(function () use ($choices, $userId) {

            DB::table('trquestionchoice')
                ->where('i_id_question', $this->record->i_id_question)
                ->delete();

            foreach ($choices as $choice) {
                DB::table('trquestionchoice')->insert([
                    'i_id_question' => $this->record->i_id_question,
                    'i_choice_sort' => (int) $choice['i_choice_sort'],
                    'n_choice'      => $choice['n_choice'],
                    'f_active'      => $choice['f_active'] ? 1 : 0,
                    'i_entry'       => $userId,
                    'd_entry'       => now(),
                    'i_update'      => $userId,
                    'd_update'      => now(),
                ]);
            }
        });
    }
}