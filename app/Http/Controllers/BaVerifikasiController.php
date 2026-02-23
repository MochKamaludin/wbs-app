<?php

namespace App\Http\Controllers;

use App\Services\BaVerifikasiService;
use App\Models\Verification;
use App\Models\Tmwbls;

class BaVerifikasiController extends Controller
{
    public function show($i_wbls)
    {
        $wbs = Tmwbls::findOrFail($i_wbls);
        $verification = Verification::where('i_wbls', $i_wbls)->firstOrFail();
        
        return BaVerifikasiService::generate($wbs, $verification);
    }
}