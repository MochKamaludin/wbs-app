<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('landing.index');
// });

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');

Route::get('/tulis-pengaduan', function () {
    return view('pengaduan.create');
})->name('tulis.pengaduan');