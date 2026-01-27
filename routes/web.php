<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengaduanController;

// Route::get('/', function () {
//     return view('landing.index');
// });

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');

Route::get('/pengaduan', [PengaduanController::class, 'index'])
    ->name('pengaduan.index');

Route::post('/pengaduan', [PengaduanController::class, 'store'])
    ->name('pengaduan.store');