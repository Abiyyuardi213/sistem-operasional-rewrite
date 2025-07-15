<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardPeranController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('dashboard-peran', [DashboardPeranController::class, 'index'])->name('dashboard-peran');

Route::post('role/{id}/toggle-status', [RoleController::class, 'toggleStatus'])->name('role.toggleStatus');
Route::resource('role', RoleController::class);
