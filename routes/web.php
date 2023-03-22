<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
	return view('Auth.login');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/aksi_login', [AuthController::class, 'aksi_login'])->name('aksi_login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
Route::get('/agen', [AdminController::class, 'agen'])->name('agen.index');
Route::get('/shuttle', [AdminController::class, 'shuttle'])->name('shuttle.index');

Route::get('/supir', [AdminController::class, 'supir'])->name('supir');
Route::get('/kota', [AdminController::class, 'kota'])->name('kota');
Route::post('/tambah_kota', [AdminController::class, 'tambah_kota'])->name('tambah.kota');
Route::put('/update_kota/{id}', [AdminController::class, 'update_kota'])->name('update.kota');
Route::get('/persediaan_tiket', [AdminController::class, 'persediaan_tiket'])->name('persediaan_tiket');
Route::post('/tambah_persediaan_tiket', [AdminController::class, 'tambah_persediaan_tiket'])->name('tambah.persediaan.tiket');
