<?php

namespace App\Filament\Resources\TrQuestions\Pages;

use App\Filament\Resources\TrQuestions\TrQuestionResource;
use App\Filament\Resources\TrQuestions\Schemas\TrQuestionEditForm;
use App\Models\Pertanyaan;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\DeleteAction;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Filament\Facades\Filament;

class EditTrQuestion extends EditRecord
{
    protected static string $resource = TrQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
            ->label('Hapus')
            ->modalHeading('Hapus Pertanyaan')
            ->modalDescription('Data yang dihapus tidak dapat dikembalikan.')
            ->modalSubmitActionLabel('Ya, Hapus')
            ->modalCancelActionLabel('Batal'),
        ];
    }

    public function getTitle(): string
    {
        return 'Edit Pertanyaan';
    }

    public function form(Schema $schema): Schema
    {
        return TrQuestionEditForm::configure($schema);
    }

    protected function beforeValidate(): void
    {
        $data = $this->form->getState();
        $sort = $data['i_question_sort'] ?? null;

        if (!$sort || !$this->record) return;

        $exists = Pertanyaan::where('c_wbls_categ', $this->record->c_wbls_categ)
            ->where('i_question_sort', (int) $sort)
            ->where('i_id_question', '!=', $this->record->i_id_question)
            ->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'i_question_sort' => "Urutan $sort sudah dipakai di kategori ini.",
            ]);
        }
    }

    protected function getRedirectUrl(): string
    {
        return static::$resource::getUrl('index');
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['choices'] = DB::table('trquestionchoice')
            ->where('i_id_question', $this->record->i_id_question)
            ->where('f_active', 1)
            ->orderBy('i_choice_sort')
            ->get()
            ->map(fn ($row) => [
                'id'            => $row->i_id_questionchoice,
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

        $data['i_update'] = Filament::auth()->user()->i_wbls_adm;
        $data['d_update'] = now();

        return $data;
    }
    protected function afterSave(): void
    {
        $choices    = $this->form->getState()['choices'] ?? [];
        $userId   = Filament::auth()->user()->i_wbls_adm;
        $questionId = $this->record->i_id_question;

        DB::transaction(function () use ($choices, $userId, $questionId) {

            $existingIds = DB::table('trquestionchoice')
                ->where('i_id_question', $questionId)
                ->pluck('i_id_questionchoice')
                ->toArray();

            $activeIds = [];

            foreach ($choices as $choice) {

                if (!empty($choice['id'])) {
                    DB::table('trquestionchoice')
                        ->where('i_id_questionchoice', $choice['id'])
                        ->update([
                            'i_choice_sort' => (int) $choice['i_choice_sort'],
                            'n_choice'      => $choice['n_choice'],
                            'f_active'      => $choice['f_active'] ? 1 : 0,
                            'i_update'      => $userId,
                            'd_update'      => now(),
                        ]);

                    $activeIds[] = $choice['id'];

                } else {
                    $newId = DB::table('trquestionchoice')->insertGetId([
                        'i_id_question' => $questionId,
                        'i_choice_sort' => (int) $choice['i_choice_sort'],
                        'n_choice'      => $choice['n_choice'],
                        'f_active'      => 1,
                        'i_entry'       => $userId,
                        'd_entry'       => now(),
                        'i_update'      => $userId,
                        'd_update'      => now(),
                    ]);

                    $activeIds[] = $newId;
                }
            }

            $idsToDeactivate = array_diff($existingIds, $activeIds);

            if (!empty($idsToDeactivate)) {
                DB::table('trquestionchoice')
                    ->whereIn('i_id_questionchoice', $idsToDeactivate)
                    ->update([
                        'f_active' => 0,
                        'i_update' => $userId,
                        'd_update' => now(),
                    ]);
            }
        });
    }

}