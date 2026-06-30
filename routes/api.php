<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BlueprintController;
use App\Http\Controllers\Api\ContentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->group(function () {

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);

        Route::apiResource('blueprints', BlueprintController::class);
    });

});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/blueprints', [BlueprintController::class, 'index']);
    Route::get('/blueprints/{blueprint}', [BlueprintController::class, 'show']);
    Route::post('/blueprints', [BlueprintController::class, 'store']);
    Route::put('/blueprints/{blueprint}', [BlueprintController::class, 'update']);
    Route::delete('/blueprints/{blueprint}', [BlueprintController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/content/repurpose', [ContentController::class, 'repurpose']);
});
