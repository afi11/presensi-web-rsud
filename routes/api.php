<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mobile\AuthController;
use App\Http\Controllers\Mobile\PresensiController;
use App\Http\Controllers\Mobile\IzinController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});


Route::group(['middleware' => 'api'], function ($router) {
    // User
    Route::put('update_profil/{code}', [AuthController::class, 'updateProfil']);
    // Presensi
    Route::get('fetch-time-presensi', [PresensiController::class, 'fetchTime']);
    Route::post('send-presensi', [PresensiController::class, 'sendPresensi']);
    Route::get('fetch-history-presensi', [PresensiController::class, 'fetchHistoryPresensi']);
    Route::get('fetch-all-history-presensi', [PresensiController::class, 'fetchAllHistoryPresensi']);
    Route::get('fetch-profil', [AuthController::class, 'getProfil']);
    Route::get('fetch-rule-izin', [IzinController::class, 'fetchRuleIzin']);
    Route::post('send-izin', [IzinController::class, 'sendIzin']);
    Route::get('fetch-histori-izin', [IzinController::class, 'fetchHistoryIzin']);
});