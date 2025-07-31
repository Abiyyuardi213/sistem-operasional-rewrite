<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BalaiYasaController;
use App\Http\Controllers\DaopsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardMasterController;
use App\Http\Controllers\DashboardPeranController;
use App\Http\Controllers\DipoLokomotifController;
use App\Http\Controllers\KantorController;
use App\Http\Controllers\KategoriResortController;
use App\Http\Controllers\KotaController;
use App\Http\Controllers\PulauController;
use App\Http\Controllers\ResortController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

    Route::middleware('checkRole:admin')->group(function () {
        Route::resource('user', UserController::class);

        Route::post('role/{id}/toggle-status', [RoleController::class, 'toggleStatus'])->name('role.toggleStatus');
        Route::resource('role', RoleController::class);
    });

    Route::get('dashboard-peran', [DashboardPeranController::class, 'index'])->name('dashboard-peran');
    Route::get('dashboard-master', [DashboardMasterController::class, 'index'])->name('dashboard-master');

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

    Route::resource('resort', ResortController::class);

    Route::post('dipo-lokomotif/{id}/toggle-status', [DipoLokomotifController::class, 'toggleStatus'])->name('dipo-lokomotif.toggleStatus');
    Route::resource('dipo-lokomotif', DipoLokomotifController::class);
});
