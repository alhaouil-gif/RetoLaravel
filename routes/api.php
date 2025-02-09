<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProfesorController as ProfesorControllerV1;
use App\Http\Controllers\API\v2\ProfesorController as ProfesorControllerV2;
use App\Http\Controllers\API\AuthController;


use App\Http\Controllers\API\ReunionController;

Route::middleware('auth:sanctum', 'role:profesor')->group(function () {
    Route::patch('/reunion/{id}/estado', [ReunionController::class, 'actualizarEstado']);


});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth:sanctum');

    
 
    // Rutas para la versión 1.0
    Route::prefix('api/v1.0')->group(function () {
        Route::middleware('auth:sanctum', 'role:profesor')->group(function () {
            Route::get('profesor/{id}/horario', [ProfesorControllerV1::class, 'obtenerHorario']);
        });
    });
    
    // Rutas para la versión 2.0
    Route::prefix('api/v2.0')->group(function () {
        Route::middleware('auth:sanctum', 'role:profesor')->group(function () {
            Route::get('profesor/{id}/horario', [ProfesorControllerV2::class, 'obtenerVersion']);
        });
        Route::get('version', [ProfesorControllerV2::class, 'obtenerVersion']);
    });
    