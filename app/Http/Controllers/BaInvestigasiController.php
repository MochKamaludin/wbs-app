<?php

namespace App\Http\Controllers;

use App\Services\BaInvestigasiService;

class BaInvestigasiController extends Controller
{
    public function download(string $i_wbls)
{
    $pdf = BaInvestigasiService::download($i_wbls);

    $filename = 'BA-Investigasi-' . str_replace('/', '-', $i_wbls) . '.pdf';

    return $pdf->download($filename);
}
}
