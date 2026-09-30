<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

// Rota de login - não precisa estar autenticado
Route::post('auth/login', [AuthController::class, 'login']);

// Rotas protegidas pelo Sanctum
Route::group([
    'middleware' => [
        'auth:sanctum',
    ]
], function () {
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('orders', OrderController::class);
    Route::apiResource('reviews', ReviewController::class);
});