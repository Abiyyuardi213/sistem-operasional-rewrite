<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardPeranController;
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

Route::post('role/{id}/toggle-status', [RoleController::class, 'toggleStatus'])->name('role.toggleStatus');
Route::resource('role', RoleController::class);

Route::resource('user', UserController::class);

Route::post('pulau/{id}/toggle-status', [PulauController::class, 'toggleStatus'])->name('pulau.toggleStatus');
Route::resource('pulau', PulauController::class);

Route::resource('kota', KotaController::class);
