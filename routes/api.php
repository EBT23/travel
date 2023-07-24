<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ApiAllController;
use App\Http\Controllers\api\ApiAuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/login', [ApiAuthController::class, 'login']);
Route::post('/register', [ApiAuthController::class, 'register']);

// KOTA
Route::get('/kota', [ApiAllController::class, 'kota']);

// TEMPAT AGEN
Route::get('/tempat_agen', [ApiAllController::class, 'tempat_agen']);

//cek persediaan tiket
Route::post('/cek_persediaan_tiket', [ApiAllController::class, 'cek_persediaan']);

//PEMESANAN
Route::get('/pemesanan', [ApiAllController::class, 'pemesanan']);
Route::post('/tambah_pemesanan', [ApiAllController::class, 'tambah_pemesanan']);
Route::delete('/delete_pemesanan', [ApiAllController::class, 'delete_pemesanan']);

Route::post('/riwayat_tiket', [ApiAllController::class, 'riwayat_tiket']);

Route::post('/cek_transaksi', [ApiAllController::class, 'cek_transaksi']);
Route::post('/cetak_tiket', [ApiAllController::class, 'cetak_tiket']);

Route::post('/updateTransaksi', [ApiAllController::class, 'updateTransaksi']);

 //Tracking
    Route::get('/tracking', [ApiAllController::class, 'tracking']);
    Route::post('/tambah_tracking', [ApiAllController::class, 'tambah_tracking']);
    Route::get('/persediaan_tiket', [ApiAllController::class, 'persediaan_tiket']);
    Route::post('/tracking_by_id_supir', [ApiAllController::class, 'tracking_by_id_supir']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [ApiAuthController::class, 'logout']);
    Route::get('/me', [ApiAuthController::class, 'me']);

    //PROFILE
    Route::post('/profile', [ApiAllController::class, 'profile']);

    //JADWAL KEBERANGKATAN
    Route::post('/jadwal_keberangkatan', [ApiAllController::class, 'jadwal_keberangkatan']);
    Route::get('/jadwal_keberangkatan_by_id/{id}', [ApiAllController::class, 'jadwal_keberangkatan_by_id']);

    //PEMESANAN
    Route::post('/input_pemesanan', [ApiAllController::class, 'input_pemesanan']);

    //SUPIR
    Route::get('/supir', [ApiAllController::class, 'supir']);
    Route::post('/tambah_supir', [ApiAllController::class, 'tambah_supir']);
    Route::put('/update_supir/{id}', [ApiAllController::class, 'update_supir']);
    Route::delete('/delete_supir/{id}', [ApiAllController::class, 'delete_supir']);

});
