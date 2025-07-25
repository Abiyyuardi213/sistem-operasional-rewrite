<?php

use App\Http\Controllers\BalaiYasaController;
use App\Http\Controllers\DaopsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardMasterController;
use App\Http\Controllers\DashboardPeranController;
use App\Http\Controllers\KantorController;
use App\Http\Controllers\KategoriResortController;
use App\Http\Controllers\KotaController;
use App\Http\Controllers\PulauController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('dashboard-peran', [DashboardPeranController::class, 'index'])->name('dashboard-peran');
Route::get('dashboard-master', [DashboardMasterController::class, 'index'])->name('dashboard-master');

Route::post('role/{id}/toggle-status', [RoleController::class, 'toggleStatus'])->name('role.toggleStatus');
Route::resource('role', RoleController::class);

Route::resource('user', UserController::class);

Route::post('pulau/{id}/toggle-status', [PulauController::class, 'toggleStatus'])->name('pulau.toggleStatus');
Route::resource('pulau', PulauController::class);

Route::resource('kota', KotaController::class);

Route::post('kantor/{id}/toggle-status', [KantorController::class, 'toggleStatus'])->name('kantor.toggleStatus');
Route::resource('kantor', KantorController::class);

Route::post('daop/{id}/toggle-status', [DaopsController::class, 'toggleStatus'])->name('daop.toggleStatus');
Route::resource('daop', DaopsController::class);

Route::post('balai-yasa/{id}/toggle-status', [BalaiYasaController::class, 'toggleStatus'])->name('balai-yasa.toggleStatus');
Route::resource('balai-yasa', BalaiYasaController::class);

Route::post('kategori-resort/{id}/toggle-status', [KategoriResortController::class, 'toggleStatus'])->name('kategori-resort.toggleStatus');
Route::resource('kategori-resort', KategoriResortController::class);
