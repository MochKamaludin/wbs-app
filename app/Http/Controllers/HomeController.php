<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DefinisiWbs;
use App\Models\Faq;
use App\Models\PerlindunganPelapor;
use App\Models\TujuanWbs;
use App\Models\SyaratMelapor;
use App\Models\CaraMelapor;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $definisi = DefinisiWbs::where('i_wbls_about', '1')->first();
        $kapanDigunakan = DefinisiWbs::where('i_wbls_about', '2')->first();
        
        $tujuanWbs = TujuanWbs::where('f_wbls_purposestat', '1')
            ->orderBy('c_wbls_purposeord')
            ->get();

        $syaratMelapor = SyaratMelapor::where('f_wbls_reqstat', '1')
            ->orderBy('c_wbls_reqord')
            ->get();

        $perlindungan = PerlindunganPelapor::where('f_wbls_protectstat', '1')
            ->orderBy('c_wbls_protectord')
            ->get();

        $dasarWbs = DefinisiWbs::where('n_wbls_about', 'Dasar WBS')->first();

        $items = [];

        if ($dasarWbs && $dasarWbs->e_wbls_about) {
            preg_match_all('/<li>(.*?)<\/li>/si', $dasarWbs->e_wbls_about, $matches);
            foreach ($matches[1] as $item) {
                $items[] = trim(strip_tags($item, '<em><strong>'));
            }
        }
        
        $faq = Faq::where('f_wbls_faqstat', '1')
            ->orderBy('i_wbls_faqseq')
            ->get();

        $steps = CaraMelapor::where('f_wbls_procstat', '1')
            ->orderByRaw('CAST(c_wbls_procord AS UNSIGNED)')
            ->get();

        $start = request('start');
        $end   = request('end');

        $query = DB::table('tmwbls');

        if ($start) {
            $query->whereDate('d_wbls', '>=', $start . '-01');
        }

        if ($end) {
            $query->whereDate(
                'd_wbls',
                '<=',
                Carbon::parse($end . '-01')->endOfMonth()
            );
        }

        $total = $query->count();

        $belumDiproses   = (clone $query)->where('c_wbls_stat', 1)->count();
        $dalamProses     = (clone $query)->where('c_wbls_stat', 4)->count();
        $selesaiDiproses = (clone $query)->whereIn('c_wbls_stat', [3, 5, 6])->count();

        $persenBelum   = $total > 0 ? round(($belumDiproses / $total) * 100, 2) : 0;
        $persenProses  = $total > 0 ? round(($dalamProses / $total) * 100, 2) : 0;
        $persenSelesai = $total > 0 ? round(($selesaiDiproses / $total) * 100, 2) : 0;

        $kategoriData = DB::table('trwblscateg')
            ->leftJoin('tmwbls', function ($join) use ($start, $end) {
                $join->on('tmwbls.c_wbls_categ', '=', 'trwblscateg.c_wbls_categ');

                if ($start) {
                    $join->whereDate('tmwbls.d_wbls', '>=', $start . '-01');
                }

                if ($end) {
                    $join->whereDate(
                        'tmwbls.d_wbls',
                        '<=',
                        Carbon::parse($end . '-01')->endOfMonth()
                    );
                }
            })
            ->select(
                'trwblscateg.c_wbls_categ',
                'trwblscateg.n_wbls_categ',
                DB::raw('COUNT(tmwbls.i_wbls) as jumlah')
            )
            ->groupBy(
                'trwblscateg.c_wbls_categ',
                'trwblscateg.n_wbls_categ'
            )
            ->orderBy('trwblscateg.c_wbls_categ')
            ->get();


        $labels = $kategoriData->pluck('n_wbls_categ');
        $dataKategori = $kategoriData->pluck('jumlah');


        return view('landing.index', compact(
            'definisi',
            'kapanDigunakan',
            'dasarWbs',
            'items',
            'tujuanWbs',
            'syaratMelapor',
            'perlindungan',
            'faq',
            'steps',

            'total',
            'belumDiproses',
            'dalamProses',
            'selesaiDiproses',
            'persenBelum',
            'persenProses',
            'persenSelesai',
            'kategoriData',
            'labels',
            'dataKategori',
            'start',
            'end'
        ));
    }
}