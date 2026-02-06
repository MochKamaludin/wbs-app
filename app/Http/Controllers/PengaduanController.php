<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    public function index()
    {
        return view('pengaduan.create', [
            'kategori' => DB::table('trwblscateg')
                ->orderBy('c_wbls_categ')
                ->get(),

            'questions' => DB::table('trquestion')
                ->where('f_active', 1)
                ->orderBy('c_wbls_categ')
                ->orderBy('i_question_sort')
                ->get()
                ->map(function ($q) {
                    $q->choices = DB::table('trquestionchoice')
                        ->where('i_id_question', $q->i_id_question)
                        ->where('f_active', 1)
                        ->orderBy('i_choice_sort')
                        ->get();
                    return $q;
                }),

            'fileCateg' => DB::table('trwblsfilecateg')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'c_wbls_categ' => 'required',
            'uraian'       => 'required|string|max:2000',
            'd_wbls_incident' => 'required|date',
            'n_wbls_categother' => $request->c_wbls_categ == '8'
                ? 'required|string|max:255'
                : 'nullable',
        ]);

        $requiredQuestions = DB::table('trquestion')
            ->where('c_wbls_categ', $request->c_wbls_categ)
            ->where('f_active', 1)
            ->where('f_required', 1)
            ->get();

        $errors = [];

        foreach ($requiredQuestions as $question) {
            $qid = $question->i_id_question;
            $answer = $request->answers[$qid] ?? null;

            // RADIO & DROPDOWN
            if (in_array($question->c_question, [2, 5])) {
                if (empty($answer)) {
                    $errors["answers.$qid"] = 'Pertanyaan dengan tanda * merah wajib diisi!';
                }
            }

            // RADIO + TEXTAREA
            elseif ($question->c_question == 4) {
                if (
                    empty($answer['choice'] ?? null) &&
                    empty($answer['text'] ?? null)
                ) {
                    $errors["answers.$qid"] = 'Pertanyaan dengan tanda * merah wajib diisi!';
                }
            }

            // FILE
            elseif ($question->c_question == 7) {
                if (! $request->hasFile("files.$qid")) {
                    $errors["files.$qid"] = 'Wajib melampirkan bukti.';
                }
            }

            // TEXT / TEXTAREA / CURRENCY
            else {
                if (empty($answer)) {
                    $errors["answers.$qid"] = 'Pertanyaan dengan tanda * merah wajib diisi!';
                }
            }

        }

        if (!empty($errors)) {
            return redirect()
                ->back()
                ->withErrors($errors)
                ->withInput();
        }

        DB::transaction(function () use ($request) {

            $seq = DB::table('tmwbls')->lockForUpdate()->max('i_wbls_seq') + 1;

            $bulan = now()->format('m');
            $tahun = now()->format('Y');

            $i_wbls = 'WBS/' .
                str_pad($seq, 4, '0', STR_PAD_LEFT) . '/PTD/' .
                $bulan . '/' . $tahun;

            DB::table('tmwbls')->insert([
                'i_wbls'            => $i_wbls,
                'i_wbls_seq'        => $seq,
                'c_wbls_categ'      => $request->c_wbls_categ,
                'n_wbls_categother' => $request->c_wbls_categ == '8'
                    ? $request->n_wbls_categother
                    : null,
                'e_wbls'            => $request->uraian,
                'd_wbls_incident'   => $request->d_wbls_incident,
                'c_wbls_stat'       => '1',
                'e_wbls_stat'       => null,
                'f_wbls_agree'      => null,
                'd_wbls'            => now(),
                'd_entry'           => now(),
            ]);


            $validQuestionIds = DB::table('trquestion')
                ->where('c_wbls_categ', $request->c_wbls_categ)
                ->where('f_active', 1)
                ->pluck('i_id_question')
                ->toArray();

            foreach ($request->answers ?? [] as $questionId => $answer) {

                if (!in_array($questionId, $validQuestionIds)) {
                    continue;
                }

                $question = DB::table('trquestion')
                    ->where('i_id_question', $questionId)
                    ->first();

                if (!$question) continue;

                $data = [
                    'i_wbls'         => $i_wbls,
                    'i_id_question' => $questionId,
                    'i_entry'       => 'Pelapor',
                    'd_entry'       => now(),
                ];

                if (in_array($question->c_question, [4, 5])) {
                    $data['i_id_questionchoice'] = $answer;
                } elseif ($question->c_question == 2 && is_array($answer)) {
                    $data['i_id_questionchoice'] = $answer['choice'] ?? null;
                    $data['e_answer'] = $answer['text'] ?? null;
                } elseif ($question->c_question == 7 && $request->hasFile("files.$questionId")) {
                    $data['e_answer'] = 'FILE_UPLOADED';
                } else {
                    $data['e_answer'] = $answer;
                }

                DB::table('tmanswer')->insert($data);
            }

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $questionId => $file) {

                    if (!in_array($questionId, $validQuestionIds)) continue;

                    $fileSeq = DB::table('tmwblsfile')
                        ->where('i_wbls', $i_wbls)
                        ->max('i_wbls_fileseq') + 1;

                    $filename = $seq . '_' .
                        now()->format('m_Y') . '_' .
                        str_pad($fileSeq, 3, '0', STR_PAD_LEFT) . '.' .
                        $file->getClientOriginalExtension();

                    $file->storeAs('wbs', $filename, 'public');

                    DB::table('tmwblsfile')->insert([
                        'i_wbls'           => $i_wbls,
                        'n_wbls_file'      => $filename,
                        'c_wbls_filecateg' => $request->file_categ[$questionId] ?? null,
                        'i_wbls_fileseq'   => $fileSeq,
                        'd_wbls_file'      => now(),
                    ]);
                }
            }
        });

        return redirect()->back()->with('success', 'Pengaduan berhasil dikirim.');
    }
}