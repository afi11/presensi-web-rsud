<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\ShiftController;
use App\Http\Controllers\Web\RuanganController;
use App\Http\Controllers\Web\PegawaiController;
use App\Http\Controllers\Web\HariLiburController;
use App\Http\Controllers\Web\JadwalController;

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
Route::resource('shift', ShiftController::class);
Route::resource('ruangan', RuanganController::class);
Route::resource('pegawai', PegawaiController::class);
Route::resource('harilibur', HariLiburController::class);

Route::get('jadwal', [JadwalController::class, 'index']);
Route::get('import_jadwal/{id}', [JadwalController::class, 'create']);
Route::post('import_jadwal', [JadwalController::class, 'import']);
Route::get('export_jadwal', [JadwalController::class, 'export']);
Route::get('fetch_jadwal/{id}', [JadwalController::class, 'fetchJadwal']);