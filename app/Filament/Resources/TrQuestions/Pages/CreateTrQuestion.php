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

        $this->choices = is_array($data['choices'] ?? null)
            ? $data['choices']
            : [];

        unset($data['choices']);

        $data['i_entry'] = $userId;
        $data['d_entry'] = now();
        $data['f_active'] = (bool) ($data['f_active'] ?? true);

        return $data;
    }

    protected function afterCreate(): void
    {
        if (empty($this->choices)) {
            return;
        }

        DB::transaction(function () {
            foreach ($this->choices as $choice) {
                DB::table('trquestionchoice')->insert([
                    'i_id_question' => $this->record->i_id_question,
                    'i_choice_sort' => (int) $choice['i_choice_sort'],
                    'n_choice'      => $choice['n_choice'],
                    'f_active'      => (bool) ($choice['f_active'] ?? true),
                    'i_entry'       => (int) Filament::auth()->user()->i_wbls_adm_id,
                    'd_entry'       => now(),
                ]);
            }
        });
    }
}
