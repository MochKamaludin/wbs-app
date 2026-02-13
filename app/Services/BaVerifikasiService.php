<?php
namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Tmwbls;

class BaVerifikasiService
{
    public static function generate(Tmwbls $wbs)
    {
        $verifikasi = $wbs->verifikasi;

        $pdf = Pdf::loadView('pdf.ba-verifikasi', [
            'wbs' => $wbs,
            'verifikasi' => $verifikasi,
        ]);

        return $pdf->stream('BA-Verifikasi.pdf');
    }
}
