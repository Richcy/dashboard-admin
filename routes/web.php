<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PendidikanPegawaiController;
use App\Http\Controllers\JabatanPegawaiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiwayatPegawaiController;
use App\Http\Controllers\DocumentPegawaiController;
use App\Http\Controllers\SertifikatPegawaiController;


// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::middleware(['login.warning'])->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/pages', [HomeController::class, 'page'])->name('page');
    Route::get('/tables', [HomeController::class, 'table'])->name('table');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::get('/pendidikan-pegawai/data', [PendidikanPegawaiController::class, 'getData'])->name('pendidikan-pegawai.data');
    Route::get('/jabatan-pegawai/data', [JabatanPegawaiController::class, 'getData'])->name('jabatan-pegawai.data');
    Route::get('/sertifikat-pegawai/data', [SertifikatPegawaiController::class, 'getData'])->name('sertifikat-pegawai.data');
    Route::get('/riwayat-pegawai/data', [RiwayatPegawaiController::class, 'getData'])->name('riwayat-pegawai.data');
    Route::get('/riwayat-pegawai', [RiwayatPegawaiController::class, 'index'])->name('riwayat-pegawai.index');
    Route::get('/pegawai-aktif', [PegawaiController::class, 'aktif'])->name('pegawai.aktif');
    Route::get('/pegawai-nonaktif', [PegawaiController::class, 'nonaktif'])->name('pegawai.nonaktif');
    Route::get('/pegawai-data/{status}', [PegawaiController::class, 'getData'])->name('pegawai.data');
    Route::get('/export-pegawai', [PegawaiController::class, 'export'])->name('pegawai.export');
    Route::post('/pegawai/import', [PegawaiController::class, 'import'])->name('pegawai.import');
    Route::get('/admin/settings', [ProfileController::class, 'edit'])->name('profile.settings');
    Route::put('/admin/settings', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/pegawai/{id}/update-foto', [DocumentPegawaiController::class, 'updateFoto'])->name('pegawai.update-foto');
    Route::prefix('pegawai/{pegawai}/dokumen')->name('document-pegawai.')->group(function () {
        Route::get('create', [DocumentPegawaiController::class, 'create'])->name('create');
        Route::post('store', [DocumentPegawaiController::class, 'store'])->name('store');
    });

    Route::resource('pegawai', PegawaiController::class);
    Route::resource('pendidikan-pegawai', PendidikanPegawaiController::class);
    Route::resource('jabatan-pegawai', JabatanPegawaiController::class);
    Route::resource('sertifikat-pegawai', SertifikatPegawaiController::class);
});
