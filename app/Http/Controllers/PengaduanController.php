<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\AesHelper;

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
            'c_wbls_categ'      => 'required',
            'uraian'            => 'required|string|max:2000',
            'd_wbls_incident'   => 'required|date',
            'n_wbls_categother' => $request->c_wbls_categ == '8'
                ? 'required|string|max:255'
                : 'nullable',
        ]);

        $fileRules = [
            1 => ['pdf', 'doc', 'docx', 'xls', 'xlsx'], 
            2 => ['mp4', 'mov', 'avi', 'mkv'],          
            3 => ['jpg', 'jpeg', 'png'],                
        ];

        $filesInput  = $request->input('files', []);
        $filesUpload = $request->file('files', []);
        $errors = [];

        foreach ($filesInput as $questionId => $rows) {
            foreach ($rows as $index => $row) {
                $categ = $row['categ'] ?? null;
                $file  = $filesUpload[$questionId][$index]['file'] ?? null;

                if (!$file && !$categ) continue;

                if (!$file || !$categ) {
                    $errors["files.$questionId"] = 'Kategori dan file wajib diisi.';
                    continue;
                }

                if (!isset($fileRules[$categ])) {
                    $errors["files.$questionId"] = 'Kategori file tidak valid.';
                    continue;
                }

                if (!$file->isValid()) {
                    $errors["files.$questionId"] = 'File tidak valid.';
                    continue;
                }

                if (!in_array(
                    strtolower($file->getClientOriginalExtension()),
                    $fileRules[$categ]
                )) {
                    $errors["files.$questionId"] =
                        'Format file tidak sesuai kategori.';
                }
            }
        }

        if (!empty($errors)) {
            return back()->withErrors($errors)->withInput();
        }

        $resi = null;

        DB::transaction(function () use ($request, &$resi) {

            $seq = DB::table('tmwbls')
                ->lockForUpdate()
                ->max('i_wbls_seq') + 1;

            $i_wbls = 'WBS/' .
                str_pad($seq, 4, '0', STR_PAD_LEFT) .
                '/PTD/' . now()->format('m/Y');

            DB::table('tmwbls')->insert([
                'i_wbls'          => $i_wbls,
                'i_wbls_seq'      => $seq,
                'c_wbls_categ'    => $request->c_wbls_categ,
                'n_wbls_categother' =>
                    $request->c_wbls_categ == '8'
                        ? $request->n_wbls_categother
                        : null,
                'e_wbls'          => $request->uraian,
                'd_wbls_incident' => $request->d_wbls_incident,
                'c_wbls_stat'     => 1,
                'd_wbls'          => now(),
                'd_entry'         => now(),
            ]);

            $plain = $i_wbls . '|' . $request->d_wbls_incident;
            $resi  = AesHelper::encrypt($plain);

            foreach ($request->answers ?? [] as $questionId => $answer) {
                DB::table('tmanswer')->insert([
                    'i_wbls'         => $i_wbls,
                    'i_id_question' => $questionId,
                    'e_answer'      => is_array($answer)
                        ? json_encode($answer)
                        : $answer,
                    'i_entry'       => 'Pelapor',
                    'd_entry'       => now(),
                ]);
            }

            $filesInput  = $request->input('files', []);
            $filesUpload = $request->file('files', []);

            foreach ($filesInput as $questionId => $rows) {
                foreach ($rows as $index => $row) {

                    $file = $filesUpload[$questionId][$index]['file'] ?? null;
                    if (!$file) continue;

                    $fileSeq = DB::table('tmwblsfile')
                        ->where('i_wbls', $i_wbls)
                        ->max('i_wbls_fileseq') + 1;

                    $filename =
                        $seq . '_' .
                        now()->format('m_Y') . '_' .
                        str_pad($fileSeq, 3, '0', STR_PAD_LEFT) . '.' .
                        $file->getClientOriginalExtension();

                    $file->storeAs('wbs', $filename, 'public');

                    DB::table('tmwblsfile')->insert([
                        'i_wbls'           => $i_wbls,
                        'i_id_question'    => $questionId,
                        'n_wbls_file'      => $filename,
                        'c_wbls_filecateg' => $row['categ'],
                        'i_wbls_fileseq'   => $fileSeq,
                        'd_wbls_file'      => now(),
                    ]);
                }
            }
        });

        return back()->with([
            'resi'    => $resi,
        ]);
    }
}