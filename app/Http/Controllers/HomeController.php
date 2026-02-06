<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DefinisiWbs;
use App\Models\Faq;
use App\Models\PerlindunganPelapor;
use App\Models\TujuanWbs;
use App\Models\SyaratMelapor;
use App\Models\CaraMelapor;
use App\Models\Tmwbls;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $definisi = DefinisiWbs::query()
        ->where('i_wbls_about', '1')
        ->first();

        $kapanDigunakan = DefinisiWbs::query()
        ->where('i_wbls_about', '2')
        ->first();
        
        $tujuanWbs = TujuanWbs::query()
        ->where('f_wbls_purposestat', '1') 
        ->orderBy('c_wbls_purposeord')
        ->get();

        $syaratMelapor = SyaratMelapor::where('f_wbls_reqstat', '1')
        ->orderBy('c_wbls_reqord')
        ->get();

        $perlindungan = PerlindunganPelapor::where('f_wbls_protectstat', '1')
        ->orderBy('c_wbls_protectord')
        ->get();

        $dasarWbs = DefinisiWbs::query()
        ->where('n_wbls_about', 'Dasar WBS')
        ->first();

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


        $total = Tmwbls::count();

        $belum = Tmwbls::where('c_wbls_stat', 1)->count();
        $proses = Tmwbls::where('c_wbls_stat', 4)->count();
        $selesai = Tmwbls::whereIn('c_wbls_stat', [5, 6])->count();

        $kategori = Tmwbls::select(
                'c_wbls_categ',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('c_wbls_categ')
            ->get();

        $grandTotal = $kategori->sum('total');

        $kategoriData = $kategori->map(function ($item) use ($grandTotal) {
            return [
                'nama' => $item->c_wbls_categ,
                'jumlah' => $item->total,
                'persen' => $grandTotal > 0
                    ? round(($item->total / $grandTotal) * 100, 2) . '%'
                    : '0%',
            ];
        });

        $labels = $kategoriData->pluck('nama');
        $dataKategori = $kategoriData->pluck('jumlah');


        return view('landing.index', compact('definisi', 'kapanDigunakan', 'dasarWbs','items', 'tujuanWbs', 'syaratMelapor', 'perlindungan', 'faq', 'steps'
                                            ,'total',
                                            'belum',
                                            'proses',
                                            'selesai',
                                            'kategoriData',
                                            'labels',
                                            'dataKategori'
    ));
    }
}  