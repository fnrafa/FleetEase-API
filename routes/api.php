<?php

use App\Http\Controllers\DriverController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::post('/user/change-password', [UserController::class, 'updatePassword']);

    Route::prefix('drivers')->group(function () {
        Route::get('/', [DriverController::class, 'index']);
        Route::middleware(['role:admin'])->group(function () {
            Route::post('/', [DriverController::class, 'store']);
            Route::put('/{id}', [DriverController::class, 'update']);
            Route::delete('/{id}', [DriverController::class, 'destroy']);
        });
    });
});
