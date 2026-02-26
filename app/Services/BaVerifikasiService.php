<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Verification;
use Carbon\Carbon;

class BaVerifikasiService
{
    public static function generatePdf(Verification $verification)
    {
        $verification->load('wbs');

        $tgl = $verification->d_wbls_vrf
            ? Carbon::parse($verification->d_wbls_vrf)
            : now();

        $filename = str_replace('/', '-', $verification->i_wbls_bavrf);

        return Pdf::loadView('pdf.ba-verifikasi', [
            'data'    => $verification,
            'hari'    => $tgl->translatedFormat('l'),
            'tanggal' => $tgl->format('d'),
            'bulan'   => $tgl->translatedFormat('F'),
            'tahun'   => $tgl->format('Y'),
        ])->stream('BA-VERIFIKASI-' . $filename . '.pdf');
    }
}