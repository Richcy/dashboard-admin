<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PegawaiController;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/pages', [HomeController::class, 'page'])->name('page');
Route::get('/tables', [HomeController::class, 'table'])->name('table');
Route::get('/pegawai/data', [PegawaiController::class, 'getPegawai'])->name('pegawai.data');
Route::resource('pegawai', PegawaiController::class);
