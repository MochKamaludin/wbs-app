<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DefinisiWbs;
use App\Models\Faq;
use App\Models\PerlindunganPelapor;
use App\Models\TujuanWbs;
use App\Models\SyaratMelapor;

class HomeController extends Controller
{
    public function index()
    {
        $definisi = DefinisiWbs::query()
        ->where('n_wbls_about', 'Whistleblowing System')
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

        $about = DefinisiWbs::where('n_wbls_about', 'Dasar WBS')->first();

        $items = [];

        if ($about && $about->e_wbls_about) {
            preg_match_all('/<li>(.*?)<\/li>/si', $about->e_wbls_about, $matches);

            foreach ($matches[1] as $item) {
                $items[] = trim(strip_tags($item, '<em><strong>'));
            }
        }
        
        $faq = Faq::where('f_wbls_faqstat', '1')
        ->orderBy('i_wbls_faqseq')
        ->get();

        return view('landing.index', compact('definisi', 'tujuanWbs', 'syaratMelapor', 'perlindungan', 'dasarWbs' , 'items', 'about', 'faq'));
    }
}  