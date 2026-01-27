<?php

namespace App\Filament\Resources\TrQuestions\Pages;

use App\Filament\Resources\TrQuestions\TrQuestionResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\DB;

class CreateTrQuestion extends CreateRecord
{
    protected static string $resource = TrQuestionResource::class;

    protected array $choices = [];

    public function getTitle(): string
    {
        return 'Tambah Pertanyaan';
    }

    protected function getRedirectUrl(): string
    {
        return static::$resource::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $userId = (int) Filament::auth()->user()->i_wbls_adm_id;

        $this->choices = $data['choices'] ?? [];
        unset($data['choices']);

        $data['i_entry'] = $userId;
        $data['d_entry'] = now();

        return $data;
    }

    protected function afterCreate(): void
    {
        if (empty($this->choices)) return;

        $userId = (int) Filament::auth()->user()->i_wbls_adm_id;

        DB::transaction(function () use ($userId) {
            foreach ($this->choices as $choice) {
                DB::table('trquestionchoice')->insert([
                    'i_id_question' => $this->record->i_id_question,
                    'i_choice_sort' => (int) $choice['i_choice_sort'],
                    'n_choice'      => $choice['n_choice'],
                    'f_active'      => $choice['f_active'] ? 1 : 0,
                    'i_entry'       => $userId,
                    'd_entry'       => now(),
                ]);
            }
        });
    }
}
