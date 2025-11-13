<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{RoleController, UserController, PatientController, DoctorController};

Route::get('/', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);
Route::resource('patients', PatientController::class)->only(['index', 'edit', 'update']);
Route::resource('doctors', DoctorController::class)->only(['index', 'edit', 'update']);
