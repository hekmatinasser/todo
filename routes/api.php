<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::prefix('/auth')->group(function () {
    Route::post('register', [AuthenticationController::class, 'register'])->name('register');
    Route::post('login', [AuthenticationController::class, 'login'])->name('login');
    Route::post('forget', [AuthenticationController::class, 'forget'])->name('forget');
    Route::post('reset', [AuthenticationController::class, 'reset'])->name('reset');
    Route::post('set-password', [AuthenticationController::class, 'setPassword'])->name('set-password');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('/auth')->group(function () {
        Route::get('profile', [AuthenticationController::class, 'profile'])->name('profile');
        Route::post('change-password', [AuthenticationController::class, 'changePassword'])->name('change-password');
        Route::post('logout', [AuthenticationController::class, 'logout'])->name('logout');
    });


});

