<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\BaInvestigasiController;
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

Route::get('/ba/pdf/{resume}', function (TmwblsResume $resume) {
    return BeritaAcaraService::generatePdf($resume);
})->name('ba.pdf');

