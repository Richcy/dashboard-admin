<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PendidikanPegawaiController;
use App\Http\Controllers\JabatanPegawaiController;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/pages', [HomeController::class, 'page'])->name('page');
Route::get('/tables', [HomeController::class, 'table'])->name('table');
Route::get('/pegawai/data', [PegawaiController::class, 'getPegawai'])->name('pegawai.data');
Route::get('/pendidikan-pegawai/data', [PendidikanPegawaiController::class, 'getData'])->name('pendidikan-pegawai.data');
Route::get('/jabatan-pegawai/data', [JabatanPegawaiController::class, 'getData'])->name('jabatan-pegawai.data');
Route::resource('pegawai', PegawaiController::class);
Route::resource('pendidikan-pegawai', PendidikanPegawaiController::class);
Route::resource('jabatan-pegawai', JabatanPegawaiController::class);
