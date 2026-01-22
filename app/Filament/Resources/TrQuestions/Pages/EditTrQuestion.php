<?php

namespace App\Filament\Resources\TrQuestions\Pages;

use App\Filament\Resources\TrQuestions\TrQuestionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\DB;

class EditTrQuestion extends EditRecord
{
    protected static string $resource = TrQuestionResource::class;

    protected array $choices = [];

    public function getTitle(): string
    {
        return 'Ubah Pertanyaan';
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
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
            ->map(fn ($item) => [
                'i_choice_sort' => $item->i_choice_sort,
                'n_choice'      => $item->n_choice,
                'f_active'      => (bool) $item->f_active,
            ])
            ->toArray();

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->choices = is_array($data['choices'] ?? null)
            ? $data['choices']
            : [];

        unset($data['choices']);

        $data['i_update'] = (int) Filament::auth()->user()->i_wbls_adm_id;
        $data['d_update'] = now();
        $data['f_active'] = (bool) ($data['f_active'] ?? true);

        return $data;
    }

    protected function afterSave(): void
    {
        DB::transaction(function () {
            DB::table('trquestionchoice')
                ->where('i_id_question', $this->record->i_id_question)
                ->delete();

            if (empty($this->choices)) {
                return;
            }

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
