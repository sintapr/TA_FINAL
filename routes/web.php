<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\OrangtuaController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FaseController;
use App\Http\Controllers\PerkembanganController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\TujuanPembelajaranController;
use App\Http\Controllers\KondisiSiswaController;






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
    return view('dashboard');
})->name('dashboard');


Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('siswa', SiswaController::class);
Route::resource('kelas', KelasController::class);
Route::resource('guru', GuruController::class);
Route::resource('orangtua', OrangtuaController::class);
Route::resource('tahun-ajaran', TahunAjaranController::class);
Route::resource('fase', FaseController::class);
Route::resource('perkembangan', PerkembanganController::class);
Route::resource('surat', SuratController::class);
Route::resource('tujuan', TujuanPembelajaranController::class);
Route::resource('kondisi-siswa', KondisiSiswaController::class);
