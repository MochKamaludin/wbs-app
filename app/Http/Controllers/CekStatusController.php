<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\AesHelper;

class CekStatusController extends Controller
{
    public function index()
    {
        return view('cek-status.index');
    }

    public function check(Request $request)
    {
        $request->validate([
            'resi' => 'required|string',
        ]);

        try {
            $plain = AesHelper::decrypt($request->resi);
            [$i_wbls, $incidentDate] = explode('|', $plain);

            $wbls = DB::table('tmwbls')
                ->where('i_wbls', $i_wbls)
                ->first();

            if (!$wbls) {
                return back()->withErrors([
                    'resi' => 'Nomor resi tidak ditemukan.',
                ]);
            }

            $status = DB::table('trwblsstat')
                ->where('c_wbls_stat', $wbls->c_wbls_stat)
                ->first();

            return view('cek-status.index', [
                'wbls'   => $wbls,
                'status' => $status,
                'resi'   => $request->resi,
            ]);

        } catch (\Throwable $e) {
            return back()->withErrors([
                'resi' => 'Nomor resi tidak valid.',
            ]);
        }
    }
}