<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProducerController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class,'user']);

    Route::prefix('producer')->group(function(){
        Route::get('/', [ProducerController::class, 'index']);
        Route::post('/', [ProducerController::class, 'store']);
        Route::put('/{producer}', [ProducerController::class, 'update']);
        Route::delete('/{producer}', [ProducerController::class, 'destroy']);
    });
});

Route::post('login', [AuthController::class, 'login']);
