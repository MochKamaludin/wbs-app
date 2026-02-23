<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\CekStatusController;
use App\Http\Controllers\WbsDownloadController;
use App\Models\Investigation;
use App\Services\BaInvestigasiService;
use App\Models\Verification;
use App\Services\BaVerifikasiService;

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

Route::get('/wbs/download/{filename}', [WbsDownloadController::class, 'download'])
    ->name('wbs.download');

Route::get('/ba/verifikasi/pdf/{verification}', function (Verification $verification) {
    return BaVerifikasiService::generatePdf($verification);
})->name('ba.verifikasi.pdf');
    
Route::get('/ba/pdf/{resume}', function (Investigation $resume) {
    return BaInvestigasiService::generatePdf($resume);
})->name('ba.laporan.pdf');