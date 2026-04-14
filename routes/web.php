<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AspirationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;


Route::get('/login', [AuthController::class, 'loginForm']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::middleware('session.auth')->group(function () {
    Route::resource('/aspirations', AspirationController::class);
    Route::get('/admin/aspirations', [AdminController::class, 'index']);
});

Route::middleware('session.auth')->group(function () {
    Route::resource('aspirations', AspirationController::class)
        ->only(['index', 'create', 'store', 'show']);
});

Route::middleware('session.auth')->group(function () {

    Route::get('/admin/aspirations', [AdminController::class, 'index'])
        ->name('admin.aspirations.index');

    Route::get('/admin/aspirations/{id}', [AdminController::class, 'show'])
        ->name('admin.aspirations.show');

    Route::put('/admin/aspirations/{id}/status', 
        [AdminController::class, 'updateStatus'])
        ->name('admin.aspirations.status');

    Route::post('/admin/aspirations/{id}/feedback', 
        [AdminController::class, 'storeFeedback'])
        ->name('admin.aspirations.feedback');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('session.auth');

