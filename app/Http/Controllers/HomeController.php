<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DefinisiWbs;
use App\Models\Faq;
use App\Models\PerlindunganPelapor;
use App\Models\TujuanWbs;
use App\Models\SyaratMelapor;
use App\Models\CaraMelapor;

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


        return view('landing.index', compact('definisi', 'kapanDigunakan', 'dasarWbs','items', 'tujuanWbs', 'syaratMelapor', 'perlindungan', 'faq', 'steps'));
    }
}  