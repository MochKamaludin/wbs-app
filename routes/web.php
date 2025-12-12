<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing.index');
});

Route::get('/tulis-pengaduan', function () {
    return view('landing.tulis_pengaduan');
})->name('tulis.pengaduan');