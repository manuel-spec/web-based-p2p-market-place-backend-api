<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\allController;
use App\Http\Controllers\UserController;

Route::prefix('api')->group(function() {
    Route::prefix('auth')->group(function () {
        Route::post('register', [authController::class, 'register']);
        Route::post('login', [authController::class, 'login']);
    });
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::put('users/{id}/update', [UserController::class, 'update']);
        Route::get('products/all', [allController::class, 'index']);
        Route::put('products/{id}/status', [allController::class, 'updateStatus']);
        Route::get('products/mine/{id}', [allController::class, 'mine']);
        
        Route::apiResource('products', ProductController::class);

    });
    Route::post('products/{id}/delete', [ProductController::class, 'destroy']);
    Route::get('/images/{filename}', [ImageController::class, 'show'])->name('image.show');
});