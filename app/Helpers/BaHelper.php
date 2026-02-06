<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BaHelper
{
    public static function generateNomor()
    {
        $bulan = Carbon::now()->format('m');
        $tahun = Carbon::now()->format('Y');

        $seq = DB::table('tmwblsresume')
            ->whereYear('d_wbls_bainvest', $tahun)
            ->max('i_wbls_bainvestseq') + 1;

        return [
            'nomor' => sprintf('BAI/%03d/PTD/%s/%s', $seq, $bulan, $tahun),
            'seq'   => $seq
        ];
    }
}
