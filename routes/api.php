<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HerdController;
use App\Http\Controllers\OverviewController;
use App\Http\Controllers\ProducerController;
use App\Http\Controllers\ProductionUnitController;
use App\Http\Controllers\RuralPropertyController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class,'user']);


    Route::prefix('report')->group(function () {
        Route::get('pdf-report', [OverviewController::class,'pdfreport']);
        Route::get('rural-properties-xlsx', [OverviewController::class,'xlsxReport']);
        Route::get('overview-graphics', [OverviewController::class,'generatedashboardsReport']);
    });

    Route::prefix('producer')->group(function(){
        Route::get('/', [ProducerController::class, 'index']);
        Route::post('/', [ProducerController::class, 'store']);
        Route::put('/{producer}', [ProducerController::class, 'update']);
        Route::delete('/{producer}', [ProducerController::class, 'destroy']);
    });

    Route::prefix('rural-property')->group(function(){
        Route::get('/', [RuralPropertyController::class, 'index']);
        Route::post('/', [RuralPropertyController::class, 'store']);
        Route::put('/{ruralProperty}', [RuralPropertyController::class, 'update']);
        Route::delete('/{ruralProperty}', [RuralPropertyController::class, 'destroy']);
    });

    Route::prefix('production-unit')->group(function(){
        Route::get('/', [ProductionUnitController::class, 'index']);
        Route::post('/', [ProductionUnitController::class, 'store']);
        Route::put('/{productionUnit}', [ProductionUnitController::class, 'update']);
        Route::delete('/{productionUnit}', [ProductionUnitController::class, 'destroy']);
    });

    Route::prefix('herd')->group(function(){
        Route::get('/', [HerdController::class, 'index']);
        Route::post('/', [HerdController::class, 'store']);
        Route::put('/{herd}', action: [HerdController::class, 'update']);
        Route::delete('/{herd}', [HerdController::class, 'destroy']);
    });
});

Route::post('login', [AuthController::class, 'login']);
