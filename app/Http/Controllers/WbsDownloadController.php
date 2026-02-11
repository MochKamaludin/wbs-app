<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class WbsDownloadController extends Controller
{
    public function download($filename)
    {
        $path = storage_path('app/public/wbs/' . $filename);

        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->download($path);
    }
}
