<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\ProductController;

Route::prefix('api')->group(function() {
    Route::prefix('auth')->group(function () {
        Route::post('register', [authController::class, 'register']);
        Route::post('login', [authController::class, 'login']);
    });
    Route::middleware('auth:sanctum')->group(function () {
        
        Route::apiResource('products', ProductController::class);
    });
    
});