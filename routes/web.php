<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PendidikanPegawaiController;
use App\Http\Controllers\JabatanPegawaiController;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::middleware(['login.warning'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/pages', [HomeController::class, 'page'])->name('page');
    Route::get('/tables', [HomeController::class, 'table'])->name('table');

    Route::get('/pendidikan-pegawai/data', [PendidikanPegawaiController::class, 'getData'])->name('pendidikan-pegawai.data');
    Route::get('/jabatan-pegawai/data', [JabatanPegawaiController::class, 'getData'])->name('jabatan-pegawai.data');
    Route::get('/pegawai-aktif', [PegawaiController::class, 'aktif'])->name('pegawai.aktif');
    Route::get('/pegawai-nonaktif', [PegawaiController::class, 'nonaktif'])->name('pegawai.nonaktif');
    Route::get('/pegawai-data/{status}', [PegawaiController::class, 'getData'])->name('pegawai.data');
    Route::get('/export-pegawai', [PegawaiController::class, 'export'])->name('pegawai.export');
    Route::post('/pegawai/import', [PegawaiController::class, 'import'])->name('pegawai.import');

    Route::resource('pegawai', PegawaiController::class);
    Route::resource('pendidikan-pegawai', PendidikanPegawaiController::class);
    Route::resource('jabatan-pegawai', JabatanPegawaiController::class);
});
