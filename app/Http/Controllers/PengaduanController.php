<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengaduanController extends Controller
{
    public function index()
    {
        return view('pengaduan.create', [
        'kategori' => DB::table('trwblscateg')
            ->orderBy('c_wbls_categ')
            ->get(),

        // PERTANYAAN
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
    ]);

    }


    public function store(Request $request)
{
    $request->validate([
        'kategori' => 'required',
        'uraian'   => 'required',
    ]);

    $seq = DB::table('tmwbls')->max('i_wbls_seq') + 1;

    $i_wbls = 'WBS/' .
        str_pad($seq, 4, '0', STR_PAD_LEFT) .
        '/PTD/' .
        date('m') . '/' .
        date('Y');

    DB::transaction(function () use ($request, $i_wbls, $seq) {

        DB::table('tmwbls')->insert([
            'i_wbls'        => $i_wbls,
            'i_wbls_seq'    => $seq,
            'c_wbls_categ'  => $request->kategori,
            'e_wbls'        => $request->uraian,
            'c_wbls_stat'   => '1', 
            'd_wbls'        => now(),
            'i_entry'       => 'guest',
            'd_entry'       => now(),
        ]);

        foreach ($request->answers ?? [] as $questionId => $value) {
            DB::table('tmanswer')->insert([
                'i_wbls'        => $i_wbls,
                'i_id_question' => $questionId,
                'e_answer'      => is_array($value) ? json_encode($value) : $value,
                'i_entry'       => 'guest',
                'd_entry'       => now(),
            ]);
        }
    });

    return redirect()
        ->route('pengaduan.create')
        ->with('success', 'Pengaduan berhasil dikirim');
}
}