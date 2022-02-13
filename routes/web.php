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

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('dashboard', [DashboardController::class, 'index']);
Route::resource('jam_kerja_shift', WaktuKerjaShiftController::class);
Route::get('create_jam_kerja_shift/{id}', [WaktuKerjaShiftController::class, 'createJamKerja']);
Route::put('store_shift_jam_kerja/{id}', [WaktuKerjaShiftController::class, 'storeJamKerja']);
Route::resource('waktu_reguler', WaktuRegulerController::class);
Route::resource('ruangan', DivisiController::class);
Route::resource('pegawai', PegawaiController::class);
Route::resource('harilibur', HariLiburController::class);
Route::resource('ruletelat', RuleTelatController::class);

Route::get('jadwal', [JadwalController::class, 'index']);
Route::get('import_jadwal/{id}', [JadwalController::class, 'create']);
Route::post('import_jadwal', [JadwalController::class, 'import']);
Route::get('export_jadwal', [JadwalController::class, 'export']);
Route::get('fetch_jadwal/{id}', [JadwalController::class, 'fetchJadwal']);