<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DefinisiWbs;

class AboutController extends Controller
{
    public function index()
    {
        $about = DefinisiWbs::latest('d_wbls_about')->first();

        return view('landing.index', compact('about'));
    }
}
