<?php

use App\Http\Controllers\Daftar;
use App\Http\Controllers\Absensi;
use App\Http\Controllers\Database;
use App\Http\Controllers\Penerimaan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administrasi;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Datatables\DataOL;
use App\Http\Controllers\Datatables\DataSurat;
use App\Http\Controllers\Datatables\DataLamaran;
use App\Http\Controllers\Datatables\DataKaryawan;
use App\Http\Controllers\Datatables\DataWawancara;
use Illuminate\Contracts\Auth\Access\Authorizable;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\Datatables\DataLegalitasKaryawan;
use App\Http\Controllers\Datatables\DataLegalitasKaryawanOl;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});

// Source untuk datatables
Route::resources([
    'getSurat' => DataSurat::class,
    'getLamaran' => DataLamaran::class,
    'getWawancara' => DataWawancara::class,
    'getKaryawan' => DataKaryawan::class,
    'getOL' => DataOL::class,
    'getLegalitasKaryawan' => DataLegalitasKaryawan::class,
    'getLegalitasKaryawanOl' => DataLegalitasKaryawanOl::class,
]);


Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'index')->name('login');
    Route::post('post-login', 'postLogin')->name('login.post');
    Route::get('registration', 'registration')->name('register');
    Route::post('post-registration', 'postRegistration')->name('register.post');
    Route::get('dashboard', 'dashboard');
    Route::get('logout', 'logout')->name('logout');
});

Route::controller(Daftar::class)->group(function () {
    Route::get('daftar/pos', 'pos')->name('daftar/pos');
    Route::get('daftar/tariflembur', 'tariflembur')->name('daftar/tariflembur');
    Route::get('daftar/liburnas', 'liburnas')->name('daftar/liburnas');
    Route::get('daftar/surat', 'surat')->name('daftar/surat');
    Route::post('storedataSurat', 'storeSurat');
    Route::get('daftar/jadwalshift', 'jadwalshift')->name('daftar/jadwalshift');
});

Route::controller(Penerimaan::class)->group(function () {
    Route::get('penerimaan/lamaran', 'lamaran')->name('penerimaan/lamaran');
    Route::get('penerimaan/wawancara', 'wawancara')->name('penerimaan/wawancara');
    Route::get('penerimaan/karyawan', 'karyawan')->name('penerimaan/karyawan');
    Route::get('penerimaan/legalitas', 'legalitas')->name('penerimaan/legalitas');

    Route::get('penerimaan/printLamaran/{id}', 'printLamaran')->name('penerimaan/printLamaran/{id}');

    Route::post('storedataLamaran', 'storeLamaran');
    Route::post('checkLamaran', 'checkLamaran');
    Route::post('storeChecklistLamaran', 'storeChecklistLamaran');
    Route::post('cancelWawancara', 'cancelWawancara');
    Route::post('checkWawancara', 'checkWawancara');
    Route::post('checkWawancaraX', 'checkWawancaraX');
    Route::post('storeChecklistWawancara', 'storeChecklistWawancara');
    Route::post('listKaryawan', 'listKaryawan');
    Route::get('penerimaan/legalitas/edit/{id}', 'legalEdit')->name('penerimaan/legalitas/edit/{id}');
});

Route::controller(Absensi::class)->group(function () {
    Route::get('absensi/absensi', 'absensi')->name('absensi/absensi');
    Route::get('absensi/komunikasi', 'komunikasi')->name('absensi/komunikasi');
    Route::get('absensi/cuti', 'cuti')->name('absensi/cuti');
});

Route::controller(Administrasi::class)->group(function () {
    Route::get('administrasi/payroll', 'payroll')->name('administrasi/payroll');
    Route::get('administrasi/terlambat', 'terlambat')->name('administrasi/terlambat');
    Route::get('administrasi/bpjs', 'bpjs')->name('administrasi/bpjs');
    Route::get('administrasi/kupon', 'kupon')->name('administrasi/kupon');
    Route::get('administrasi/lembur', 'lembur')->name('administrasi/lembur');
});

Route::controller(Database::class)->group(function () {
    Route::get('database/lokasi', 'lokasi')->name('database/lokasi');
    Route::get('database/sink', 'sink')->name('database/sink');
});
