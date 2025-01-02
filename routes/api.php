<?php

use App\Http\Controllers\DriverController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::prefix('users')->group(function () {
        Route::post('/change-password', [UserController::class, 'updatePassword']);
        Route::middleware(['role:admin'])->group(function () {
            Route::get('/', [UserController::class, 'index']);
            Route::get('/{id}', [UserController::class, 'show']);
            Route::put('/{id}/position', [UserController::class, 'updatePosition']);
        });
    });

    Route::middleware(['role:admin'])->prefix('positions')->group(function () {
        Route::get('/', [PositionController::class, 'index']);
        Route::post('/', [PositionController::class, 'store']);
        Route::put('/{id}', [PositionController::class, 'update']);
    });

    Route::prefix('drivers')->group(function () {
        Route::get('/', [DriverController::class, 'index']);
        Route::middleware(['role:admin'])->group(function () {
            Route::post('/', [DriverController::class, 'store']);
            Route::put('/{id}', [DriverController::class, 'update']);
            Route::delete('/{id}', [DriverController::class, 'destroy']);
        });
    });

    Route::prefix('vehicles')->group(function () {
        Route::get('/', [VehicleController::class, 'index']);
        Route::post('/', [VehicleController::class, 'store']);
        Route::put('/{id}', [VehicleController::class, 'update']);
        Route::delete('/{id}', [VehicleController::class, 'destroy']);
    });
});
