<?php

namespace App\Services;

use App\Models\TmwblsResume;
use App\Models\Tmwbls;
use App\Helpers\BaHelper;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BeritaAcaraService
{
    public static function generateAndUpdate(Tmwbls $wbls)
    {
        return DB::transaction(function () use ($wbls) {

            $resume = TmwblsResume::firstOrCreate(
                ['i_wbls' => $wbls->i_wbls],
                [
                    'i_wbls_adm'    => Auth::user()->i_wbls_adm,
                    'e_wbls_resume' => 'Hasil investigasi masih dalam proses.',
                    'd_wbls_resume' => now(),
                ]
            );

            if (!$resume->i_wbls_bainvest) {
                $ba = BaHelper::generateNomor();

                $resume->update([
                    'i_wbls_bainvest'    => $ba['nomor'],
                    'i_wbls_bainvestseq' => $ba['seq'],
                    'd_wbls_bainvest'    => now(),
                ]);
            }


            return self::generatePdf($resume);
        });
    }

    public static function generatePdf(TmwblsResume $resume)
    {
        $resume->load('wbls');

        $tgl = Carbon::parse($resume->d_wbls_bainvest);

        $filename = str_replace('/', '-', $resume->i_wbls_bainvest);

        return Pdf::loadView('pdf.berita-acara', [
            'data'    => $resume,
            'hari'    => $tgl->translatedFormat('l'),
            'tanggal' => $tgl->format('d'),
            'bulan'   => $tgl->translatedFormat('F'),
            'tahun'   => $tgl->format('Y'),
        ])->stream('BA-' . $filename . '.pdf');
    }

}