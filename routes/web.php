<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\allController;

Route::prefix('api')->group(function() {
    Route::prefix('auth')->group(function () {
        Route::post('register', [authController::class, 'register']);
        Route::post('login', [authController::class, 'login']);
    });
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('products/all', [allController::class, 'index']);
        Route::put('products/{id}/status', [allController::class, 'updateStatus']);
        
        Route::apiResource('products', ProductController::class);

    });
    Route::get('/images/{filename}', [ImageController::class, 'show'])->name('image.show');
});