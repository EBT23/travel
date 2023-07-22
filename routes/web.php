<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

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
	return view('auth.login');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/aksi_login', [AuthController::class, 'aksi_login'])->name('aksi_login');
Route::get('/register', [AuthController::class, 'register'])->name('register');



Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

Route::get('/roles',[AdminController::class,'roles'])->name('roles');
Route::post('/tambah_roles',[AdminController::class,'tambah_roles'])->name('tambah.roles');
Route::post('/edit_roles/{id}',[AdminController::class,'edit_roles'])->name('edit.roles');
Route::post('/hapus_roles/{id}',[AdminController::class,'hapus_roles'])->name('hapus.roles');

Route::get('/rute', [AdminController::class, 'rute'])->name('rute');
Route::post('/tambah_rute', [AdminController::class, 'tambah_rute'])->name('tambah.rute');
Route::post('/update_rute/{id}', [AdminController::class, 'update_rute'])->name('update.rute');
Route::get('/edit_rute/{id}', [AdminController::class, 'edit_rute'])->name('edit.rute');
Route::delete('/delete_rute/{id}', [AdminController::class, 'delete_rute'])->name('delete.rute');

Route::get('/armada', [AdminController::class, 'armada'])->name('armada');
Route::post('/tambah_armada', [AdminController::class, 'tambah_armada'])->name('tambah.armada');
Route::post('/update_armada/{id}', [AdminController::class, 'update_armada'])->name('update.armada');
Route::get('/edit_armada/{id}', [AdminController::class, 'edit_armada'])->name('edit.armada');
Route::delete('/delete_armada/{id}', [AdminController::class, 'hapus_armada'])->name('delete.armada');

Route::get('/fasilitas', [AdminController::class, 'fasilitas'])->name('fasilitas');
Route::post('/tambah_fasilitas', [AdminController::class, 'tambah_fasilitas'])->name('tambah.fasilitas');
Route::post('/update_fasilitas/{id}', [AdminController::class, 'update_fasilitas'])->name('update.fasilitas');
Route::get('/edit_fasilitas/{id}', [AdminController::class, 'edit_fasilitas'])->name('edit.fasilitas');
Route::delete('/delete_fasilitas/{id}', [AdminController::class, 'hapus_fasilitas'])->name('delete.fasilitas');

Route::get('/detail_fasilitas', [AdminController::class, 'detail_fasilitas'])->name('detail_fasilitas');
Route::post('/tambah_detail_fasilitas', [AdminController::class, 'tambah_detail_fasilitas'])->name('tambah.detail.fasilitas');
Route::post('/update_detail_fasilitas/{id}', [AdminController::class, 'update_detail_fasilitas'])->name('update.detail.fasilitas');
Route::get('/edit_detail_fasilitas/{id}', [AdminController::class, 'edit_detail_fasilitas'])->name('edit.detail.fasilitas');
Route::delete('/delete_detail_fasilitas/{id}', [AdminController::class, 'hapus_detail_fasilitas'])->name('delete.detail.fasilitas');

Route::get('/tracking', [AdminController::class, 'tracking'])->name('tracking');

Route::get('/supir', [AdminController::class, 'supir'])->name('supir');
Route::post('/tambah-supir', [AdminController::class, 'tambah_supir'])->name('tambah.supir');
Route::post('/update-supir/{id}', [AdminController::class, 'edit_supir'])->name('edit.supir');
Route::delete('/delete-supir/{id}',[AdminController::class,'hapus_supir'])->name('hapus.supir');

Route::get('/kota', [AdminController::class, 'kota'])->name('kota');
Route::post('/tambah_kota', [AdminController::class, 'tambah_kota'])->name('tambah.kota');
Route::post('/update_kota/{id}', [AdminController::class, 'update_kota'])->name('update.kota');
Route::get('/form_edit_kota/{id}', [AdminController::class, 'form_edit_kota'])->name('form.edit.kota');
Route::delete('/delete_kota/{id}', [AdminController::class, 'hapus_kota'])->name('delete.kota');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/jadwal', [AdminController::class, 'jadwal'])->name('jadwal');
Route::post('/tambah_jadwal', [AdminController::class, 'tambah_jadwal'])->name('tambah.jadwal');
Route::post('/update_jadwal/{id}', [AdminController::class, 'update_jadwal'])->name('update.jadwal');
Route::get('/edit_jadwal/{id}', [AdminController::class, 'edit_jadwal'])->name('edit.jadwal');
Route::delete('/delete_jadwal/{id}', [AdminController::class, 'delete_jadwal'])->name('delete.jadwal');

Route::get('/pemesanan',[AdminController::class, 'pemesanan'])->name('pemesanan');

Route::get('/route-cache', function () {
	Artisan::call('route:cache');
	return 'Routes cache cleared';
});
Route::get('/config-cache', function () {
	Artisan::call('config:cache');
	return 'Config cache cleared';
});
Route::get('/clear-cache', function () {
	Artisan::call('cache:clear');
	return 'Application cache cleared';
});
Route::get('/view-clear', function () {
	Artisan::call('view:clear');
	return 'View cache cleared';
});
Route::get('/optimize', function () {
	Artisan::call('optimize');
	return 'Routes cache cleared';
});
