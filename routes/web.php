<?php

use App\Http\Controllers\Daftar;
use App\Http\Controllers\Absensi;
use App\Http\Controllers\DBLokal;
use App\Http\Controllers\Database;
use App\Http\Controllers\Penerimaan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administrasi;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Datatables\DataOL;
use App\Http\Controllers\Datatables\DataPos;
use App\Http\Controllers\Datatables\DataLoker;
use App\Http\Controllers\Datatables\DataShift;
use App\Http\Controllers\Datatables\DataSurat;
use App\Http\Controllers\Datatables\DataEntitas;
use App\Http\Controllers\Datatables\DataLamaran;
use App\Http\Controllers\Datatables\DataPayroll;
use App\Http\Controllers\Datatables\DataKaryawan;
use App\Http\Controllers\Datatables\DataHariLibur;
use App\Http\Controllers\Datatables\DataTerlambat;
use App\Http\Controllers\Datatables\DataWawancara;
use Illuminate\Contracts\Auth\Access\Authorizable;
use App\Http\Controllers\Datatables\DataFingerODBC;
use App\Http\Controllers\Datatables\DataKomunikasi;
use App\Http\Controllers\Datatables\DataFingerMYSQL;
use App\Http\Controllers\Datatables\DataTarifLembur;
use App\Http\Controllers\Datatables\DataAbsensiLocal;
use App\Http\Controllers\Datatables\DataFixedAbsensi;
use App\Http\Controllers\Datatables\DataUserinfoODBC;
use App\Http\Controllers\Datatables\DataACCKomunikasi;
use App\Http\Controllers\Datatables\DataUserinfoMYSQL;
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

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

Route::get('/', function () {
    if (Auth::check()) {
        return view('products.dashboard');
    } else {
        // return view('login');
        return redirect("login")->withSuccess('Opps! You do not have access');
    }
});

// Modules Source untuk datatables
Route::resources([
    'getSurat' => DataSurat::class,
    'getPos'    => DataPos::class,
    'getLamaran' => DataLamaran::class,
    'getWawancara' => DataWawancara::class,
    'getKaryawan' => DataKaryawan::class,
    'getOL' => DataOL::class,
    'getLegalitasKaryawan' => DataLegalitasKaryawan::class,
    'getLegalitasKaryawanOl' => DataLegalitasKaryawanOl::class,
    'getAbsensiLocal' => DataAbsensiLocal::class,
    'getUserODBC' => DataUserinfoODBC::class,
    'getUserMYSQL' => DataUserinfoMYSQL::class,
    'getFingerODBC' => DataFingerODBC::class,
    'getFingerMYSQL' => DataFingerMYSQL::class,
    'getLembur' => DataTarifLembur::class,
    'getLibur'  => DataHariLibur::class,
    'getshift' => DataShift::class,
    'getentitas' => DataEntitas::class,
    'getListKomunikasi' => DataKomunikasi::class,
    'getAccKomunikasi' => DataACCKomunikasi::class,
    'getLoker' => DataLoker::class,
    'getPayroll' => DataPayroll::class,
    'getTerlambat' => DataTerlambat::class,
]);

// Modules Auth
Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'index')->name('login');
    Route::post('post-login', 'postLogin')->name('login.post');
    Route::get('registration', 'registration')->name('register');
    Route::post('post-registration', 'postRegistration')->name('register.post');
    Route::get('dashboard', 'dashboard');
    Route::get('logout', 'logout')->name('logout');
});

// Modules Daftar
Route::controller(Daftar::class)->group(function () {

    //Routes Pos Pekerjaan DONE
    Route::get('daftar/pos', 'pos')->name('daftar/pos');
    Route::post('storedataPos', 'storePos');
    Route::post('listPos', 'listPos');
    Route::post('pos/update', 'updatePos');

    //Routes Tarif Lembur DONE
    Route::get('daftar/tariflembur', 'tariflembur')->name('daftar/tariflembur');
    Route::post('storedataLembur', 'storelembur');
    Route::post('viewlembur', 'lemburview');
    Route::post('update/lembur', 'updatelembur');

    //Routes libur nasional DONE
    Route::get('daftar/liburnas', 'liburnas')->name('daftar/liburnas');
    Route::post('storedataLibur', 'storelibur');
    Route::post('detail/liburnas', 'liburnasview');
    // Route::post('update/liburnas', 'updateliburnas');
    Route::post('generateYear', 'generateLiburNasional');


    //routes Surat-surat DONE
    Route::get('daftar/surat', 'surat')->name('daftar/surat');
    Route::post('storedataSurat', 'storeSurat');
    Route::post('update/surat', 'updatesurat');
    Route::post('detail/surat', 'viewsurat');

    //routes jadwal shif DONE
    Route::get('daftar/jadwalshift', 'jadwalshift')->name('daftar/jadwalshift');
    Route::post('storedatashift', 'storeshift');
    Route::post('viewshift', 'shiftview');
    Route::post('shift/update', 'updateshif');

    //Routes daftar entitas
    Route::get('daftar/entitas', 'entitas');
    Route::post('detail/entitas', 'viewentitas');
    Route::post('storedataEntitas', 'storeentitas');
    Route::post('update/entitas', 'updateentitas');

    // Routes Lowongan Pekerjaan
    Route::get('daftar/loker', 'loker');
    Route::post('storeDataLoker', 'storeLoker');
});

// Modules Penerimaan
Route::controller(Penerimaan::class)->group(function () {
    Route::get('penerimaan/lamaran', 'lamaran')->name('penerimaan/lamaran');
    Route::post('listLamaran', 'listLamaran');
    Route::get('penerimaan/wawancara', 'wawancara')->name('penerimaan/wawancara');
    Route::get('penerimaan/karyawan', 'karyawan')->name('penerimaan/karyawan');
    Route::get('penerimaan/legalitas', 'legalitas')->name('penerimaan/legalitas');

    Route::get('penerimaan/printLamaran/{id}', 'printLamaran')->name('penerimaan/printLamaran/{id}');

    Route::post('storedataLamaran', 'storeLamaran');
    Route::post('checkLamaran', 'checkLamaran');
    Route::post('storeChecklistLamaran', 'storeChecklistLamaran');
    Route::post('cancelWawancara', 'cancelWawancara');
    Route::post('prosesWawancara', 'prosesWawancara');
    Route::post('checkWawancara', 'checkWawancara');
    Route::post('checkWawancaraX', 'checkWawancaraX');
    Route::post('storeChecklistWawancara', 'storeChecklistWawancara');
    Route::post('storeHasilWawancara', 'storeHasilWawancara');
    Route::post('listKaryawan', 'listKaryawan');
    Route::post('listStb', 'listStb');
    Route::get('penerimaan/legalitas/edit/{id}', 'legalEdit')->name('penerimaan/legalitas/edit/{id}');
    Route::post('storedataLegalitas', 'storedataLegalitas');
});

// Modules Absensi
Route::controller(Absensi::class)->group(function () {

    Route::get('absensi/absensi', 'absensi')->name('absensi/absensi');
    Route::get('absensi/fingerprint', 'fingerprint')->name('absensi/fingerprint');
    Route::get('absensi/komunikasi', 'komunikasi')->name('absensi/komunikasi');
    Route::get('absensi/cuti', 'cuti')->name('absensi/cuti');

    Route::post('getabsensi', 'getabsensi')->name('getabsensi');
    Route::post('listAbsensiDetail', 'listAbsensiDetail');
    Route::post('getalpha', 'getalpha')->name('getalpha');
    Route::post('getalphabydate', 'getalphabydate')->name('getalphabydate');
    Route::post('storedataKomunikasi', 'storeKomunikasi');

    Route::get('absensi/komunikasi/printKomunikasi/{id}', 'printSurat')->name('absensi/komunikasi/printKomunikasi/{id}');
    Route::post('checkAccKomunikasi', 'checkAccKomunikasi');
    Route::post('absensi/storeAcc', 'storeKomunikasiAcc')->name('absensi/storeAcc');
});

// Modules Penarikan Data Mesin Fingerprint
Route::controller(DBLokal::class)->group(function () {
    Route::get('lokal/mesinfinger', 'mesinfinger')->name('lokal/mesinfinger');
    Route::get('lokal/daftarfinger', 'daftarfinger')->name('lokal/daftarfinger');
    Route::get('lokal/rawfinger', 'rawfinger')->name('lokal/rawfinger');
    Route::get('lokal/localabsence', 'localabsence')->name('lokal/localabsence');

    Route::post('syncFromAccess', 'syncFromAccess');
    Route::post('syncFromSelectedMysql', 'syncFromSelectedMysql');
    Route::post('syncCheckinout', 'syncCheckinout');
    Route::post('syncAbsen', 'syncAbsen');
    Route::post('uploadAbsen', 'uploadAbsen');
    Route::post('perbaruiUploadAbsen', 'perbaruiUploadAbsen');
    Route::post('UploadFixedAbsen', 'UploadFixedAbsen');
    Route::post('perbaruiUploadAbsenBulan', 'perbaruiUploadAbsenBulan');
});

// Modules Administrasi
Route::controller(Administrasi::class)->group(function () {
    Route::get('administrasi/payroll', 'payroll')->name('administrasi/payroll');
    Route::get('administrasi/terlambat', 'terlambat')->name('administrasi/terlambat');
    Route::get('administrasi/bpjs', 'bpjs')->name('administrasi/bpjs');
    Route::get('administrasi/kupon', 'kupon')->name('administrasi/kupon');
    Route::get('administrasi/lembur', 'lembur')->name('administrasi/lembur');

    Route::get('/payroll/export_excel', 'exportPayroll')->name('/payroll/export_excel');
    Route::post('getpayroll', 'getpayroll')->name('getpayroll');
    Route::post('generatePayroll', 'generatePayroll')->name('generatePayroll');
    Route::post('generatePayroll', 'generatePayroll')->name('generatePayroll');
    Route::post('/umr/update', 'updateumr')->name('/umr/update');
    Route::post('/payroll/import_excel', 'importPayroll')->name('/payroll/import_excel');
    Route::post('listBPJSKaryawan', 'listBPJSKaryawan');
    Route::post('pos/update', 'updatePos');
    Route::post('updateBPJS', 'updateBPJS');
    Route::post('bpjsupdate', 'updateUpahBpjs')->name('bpjsupdate');
});

// Modules Database
Route::controller(Database::class)->group(function () {
    Route::get('database/lokasi', 'lokasi')->name('database/lokasi');
});
