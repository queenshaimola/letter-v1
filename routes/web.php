<?php

use Illuminate\Support\Facades\Route;

// 1. Halaman Awal / Cover (Video Background, Judul "The COUNTLESS words", & Tombol "Here")
Route::get('/', function () {
    return view('welcome');
});

// 2. Halaman Isi Surat (Kertas Surat Vintage + Efek Mengetik)
Route::get('/letter', function () {
    return view('letter-content');
});

// Route untuk halaman quotes / fade-in text
Route::get('/quotes', function () {
    return view('quotes');
});