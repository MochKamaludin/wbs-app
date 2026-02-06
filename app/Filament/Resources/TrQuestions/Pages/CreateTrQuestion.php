<?php

namespace App\Filament\Resources\TrQuestions\Pages;

use App\Filament\Resources\TrQuestions\TrQuestionResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\TrQuestion;

class CreateTrQuestion extends CreateRecord
{
    protected static string $resource = TrQuestionResource::class;

    public function getTitle(): string
    {
        return 'Tambah Pertanyaan';
    }

    protected function handleRecordCreation(array $data): Model
    {
        DB::transaction(function () use ($data) {

            $userId   = Filament::auth()->user()->i_wbls_adm;
            $kategori = $data['c_wbls_categ'];

            foreach ($data['questions'] as $question) {

                $q = TrQuestion::create([
                    'c_wbls_categ'    => $kategori,
                    'i_question_sort' => $question['i_question_sort'],
                    'n_question'      => $question['n_question'],
                    'c_question'      => $question['c_question'],
                    'f_required'      => $question['f_required'],
                    'f_active'        => $question['f_active'],
                    'i_entry'         => $userId,
                    'd_entry'         => now(),
                ]);
                
                if (!empty($question['choices'])) {
                    foreach ($question['choices'] as $choice) {
                        DB::table('trquestionchoice')->insert([
                            'i_id_question' => $q->i_id_question,
                            'i_choice_sort' => $choice['i_choice_sort'],
                            'n_choice'      => $choice['n_choice'],
                            'f_active'      => $choice['f_active'] ? 1 : 0,
                            'i_entry'       => $userId,
                            'd_entry'       => now(),
                        ]);
                    }
                }
            }
        });

        return new TrQuestion();
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Semua pertanyaan berhasil disimpan';
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }

}
