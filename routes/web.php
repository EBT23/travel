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
Route::post('/tambah_agen', [AdminController::class, 'tambah_agen'])->name('tambah.agen');
Route::post('/update_agen/{id}', [AdminController::class, 'update_agen'])->name('update.agen');
Route::get('/edit_agen/{id}', [AdminController::class, 'edit_agen'])->name('edit.agen');
Route::delete('/delete_tempat_agen/{id}', [AdminController::class, 'hapus_tempat_agen'])->name('delete.tempat.agen');

Route::get('/shuttle', [AdminController::class, 'shuttle'])->name('shuttle.index');
Route::post('/tambah_shuttle', [AdminController::class, 'tambah_shuttle'])->name('tambah.shuttle');
Route::post('/update_shuttle/{id}', [AdminController::class, 'update_shuttle'])->name('update.shuttle');
Route::get('/edit_shuttle/{id}', [AdminController::class, 'edit_shuttle'])->name('edit.shuttle');
Route::delete('/delete_shuttle/{id}', [AdminController::class, 'hapus_shuttle'])->name('delete.shuttle');

Route::get('/supir', [AdminController::class, 'supir'])->name('supir');
Route::get('/kota', [AdminController::class, 'kota'])->name('kota');
Route::post('/tambah_kota', [AdminController::class, 'tambah_kota'])->name('tambah.kota');
Route::post('/update_kota/{id}', [AdminController::class, 'update_kota'])->name('update.kota');
Route::get('/form_edit_kota/{id}', [AdminController::class, 'form_edit_kota'])->name('form.edit.kota');
Route::delete('/delete_kota/{id}', [AdminController::class, 'hapus_kota'])->name('delete.kota');

Route::get('/persediaan_tiket', [AdminController::class, 'persediaan_tiket'])->name('persediaan_tiket');
Route::post('/tambah_persediaan_tiket', [AdminController::class, 'tambah_persediaan_tiket'])->name('tambah.persediaan.tiket');
Route::post('/update_persediaan_tiket/{id}', [AdminController::class, 'update_persediaan_tiket'])->name('update.persediaan.tiket');
Route::get('/form_edit_persediaan/{id}', [AdminController::class, 'form_edit_persediaan'])->name('form.edit.persediaan');
Route::delete('/delete_persediaan_tiket/{id}', [AdminController::class, 'delete_persediaan_tiket'])->name('delete.persediaan.tiket');