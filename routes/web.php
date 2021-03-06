<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\WaktuKerjaShiftController;
use App\Http\Controllers\Web\WaktuRegulerController;
use App\Http\Controllers\Web\DivisiController;
use App\Http\Controllers\Web\PegawaiController;
use App\Http\Controllers\Web\HariLiburController;
use App\Http\Controllers\Web\JadwalController;
use App\Http\Controllers\Web\RuleTelatController;
use App\Http\Controllers\Web\PresensiController;
use App\Http\Controllers\Web\HasilPresensiController;
use App\Http\Controllers\Mobile\AuthController;
use App\Http\Controllers\Web\AuthWebController;
use App\Http\Controllers\Web\PenggunaController;
use App\Http\Controllers\Web\CutiController;
use App\Http\Controllers\Web\PresensiV2Controller;

Route::get('login', [AuthWebController::class, 'index']);
Route::post('proses_login', [AuthWebController::class, 'prosesLogin']);
Route::get('logout', [AuthWebController::class, 'logout']);

Route::middleware('ceklogin')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::resource('jam_kerja_shift', WaktuKerjaShiftController::class);
    Route::get('create_jam_kerja_shift/{id}', [WaktuKerjaShiftController::class, 'createJamKerja']);
    Route::put('store_shift_jam_kerja/{id}', [WaktuKerjaShiftController::class, 'storeJamKerja']);
    Route::resource('waktu_reguler', WaktuRegulerController::class);
    Route::resource('ruangan', DivisiController::class);
    Route::resource('pegawai', PegawaiController::class);
    Route::resource('harilibur', HariLiburController::class);
    Route::resource('ruletelat', RuleTelatController::class);
    Route::resource('pengguna', PenggunaController::class);

    Route::post('import_pegawai', [PegawaiController::class, 'import']);
    Route::resource('sinkronisasi', PresensiController::class);
    Route::get('view_sinkronisasi_presensi', [PresensiController::class, 'crosCheckView']);
    Route::post('sinkronisasi_presensi', [PresensiController::class, 'prosesSinkronisasi']);
    Route::get('fetch_log_presensi', [PresensiController::class, 'fetchHistoryPresensi']);
    Route::get('export_excel_presensi/{ruangan}', [PresensiController::class, 'exportExcel']);

    Route::get('jadwal', [JadwalController::class, 'index']);
    Route::get('import_jadwal/{id}', [JadwalController::class, 'create']);
    Route::post('import_jadwal', [JadwalController::class, 'import']);
    Route::get('export_jadwal', [JadwalController::class, 'export']);
    Route::get('fetch_jadwal/{id}', [JadwalController::class, 'fetchJadwal']);

    Route::resource('riwayat_presensi', HasilPresensiController::class);
    Route::get('view_record_presensi/{id}', [HasilPresensiController::class, 'viewRecordPresensi']);
    Route::get('fetch_record_presensi/{id}', [HasilPresensiController::class, 'fetchRecordPresensi']);

    Route::resource('pengajuan_cuti', CutiController::class);
    Route::get('pengajuan_cuti/pegawai/{code}', [CutiController::class, 'showCuti']);

    Route::get('report-presensi', [PresensiV2Controller::class, 'index']);
    Route::get('report-presensi/{id}', [PresensiV2Controller::class, 'show']);
    Route::get('fetch-history-presensi-v2', [PresensiV2Controller::class, 'fetchHistoryPresensi']);
    Route::post('sinkronisasi-presensi-v2', [PresensiV2Controller::class, 'prosesSinkronisasi']);
});

Route::get('37b60eda89b5204fc5beda94005abe90d8cc6d25/{code}', [AuthController::class, 'viewResetPassword']);
Route::post('proses_reset_password/{code}', [AuthController::class, 'changePasswordUser']);
Route::get('hasil_reset_password', [AuthController::class, 'viewHasilPassword']);