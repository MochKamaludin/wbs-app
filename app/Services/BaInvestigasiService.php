<?php

namespace App\Services;

use App\Models\Investigation;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class BaInvestigasiService
{
    public static function generatePdf(Investigation $resume)
    {
        $resume->load('wbls');

        $tgl = Carbon::parse($resume->d_wbls_bainvest);

        $filename = str_replace('/', '-', $resume->i_wbls_bainvest);

        return Pdf::loadView('pdf.ba-investigasi', [
            'data'    => $resume,
            'hari'    => $tgl->translatedFormat('l'),
            'tanggal' => $tgl->format('d'),
            'bulan'   => $tgl->translatedFormat('F'),
            'tahun'   => $tgl->format('Y'),
        ])->stream('BA-INVESTIGASI' . $filename . '.pdf');
    }
}