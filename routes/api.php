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



Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [ApiAuthController::class, 'logout']);
    Route::get('/me', [ApiAuthController::class, 'me']);

    //PROFILE
    Route::post('/profile', [ApiAllController::class, 'profile']);

    //ROLE
    Route::get('/role', [ApiAllController::class, 'role']);
    Route::post('/tambah_role', [ApiAllController::class, 'tambah_role']);
    Route::put('/update_role/{id}', [ApiAllController::class, 'update_role']);
    Route::delete('/delete_role/{id}', [ApiAllController::class, 'delete_role']);
    Route::get('/get_role/{id}', [ApiAllController::class, 'get_role']);
    //SHUTTLE
    Route::get('/shuttle', [ApiAllController::class, 'shuttle']);
    Route::post('/tambah_shuttle', [ApiAllController::class, 'tambah_shuttle']);
    Route::put('/update_shuttle/{id}', [ApiAllController::class, 'update_shuttle']);
    Route::delete('/delete_shuttle/{id}', [ApiAllController::class, 'delete_shuttle']);
    Route::get('/get_shuttle/{id}', [ApiAllController::class, 'get_shuttle']);
    //PERSEDIAAN TIKET
    Route::get('/persediaan_tiket', [ApiAllController::class, 'persediaan_tiket']);
    Route::post('/tambah_persediaan_tiket', [ApiAllController::class, 'tambah_persediaan_tiket']);
    Route::put('/update_persediaan_tiket/{id}', [ApiAllController::class, 'update_persediaan_tiket']);
    Route::delete('/delete_persediaan_tiket/{id}', [ApiAllController::class, 'delete_persediaan_tiket']);
    Route::get('/get_persediaan/{id}', [ApiAllController::class, 'get_persediaan']);

    //SUPIR
    Route::get('/supir', [ApiAllController::class, 'supir']);
    Route::post('/tambah_supir', [ApiAllController::class, 'tambah_supir']);
    Route::put('/update_supir/{id}', [ApiAllController::class, 'update_supir']);
    Route::delete('/delete_supir/{id}', [ApiAllController::class, 'delete_supir']);

    // KOTA
    Route::post('/tambah_kota', [ApiAllController::class, 'tambah_kota']);
    Route::put('/update_kota/{id}', [ApiAllController::class, 'update_kota']);
    Route::delete('/delete_kota/{id}', [ApiAllController::class, 'delete_kota']);
    Route::get('/get_kota/{id}', [ApiAllController::class, 'get_kota']);

    // TEMPAT AGEN
    Route::post('/tambah_tempat_agen', [ApiAllController::class, 'tambah_tempat_agen']);
    Route::put('/update_tempat_agen/{id}', [ApiAllController::class, 'update_tempat_agen']);
    Route::delete('/delete_tempat_agen/{id}', [ApiAllController::class, 'delete_tempat_agen']);
    Route::get('/get_tempat_agen/{id}', [ApiAllController::class, 'get_tempat_agen']);
});
