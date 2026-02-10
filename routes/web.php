<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\CekStatusController;
use App\Models\TmwblsResume;
use App\Services\BeritaAcaraService;


// Route::get('/', function () {
//     return view('landing.index');
// });

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');

Route::get('/pengaduan', [PengaduanController::class, 'index'])
    ->name('pengaduan.index');

Route::post('/pengaduan', [PengaduanController::class, 'store'])
    ->name('pengaduan.store');

Route::get('/cek-status', [CekStatusController::class, 'index'])
    ->name('cek-status.index');

Route::post('/cek-status', [CekStatusController::class, 'check'])
    ->name('cek-status.check');

Route::get('/storage/wbs/{filename}', function ($filename) {
    $path = storage_path('app/public/wbs/' . $filename);
    
    if (!file_exists($path)) {
        abort(404);
    }
    
    return response()->download($path);
})->name('wbs.download');

Route::get('/ba/pdf/{resume}', function (TmwblsResume $resume) {
    return BeritaAcaraService::generatePdf($resume);
})->name('ba.pdf');

