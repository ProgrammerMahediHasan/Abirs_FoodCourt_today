<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CouponController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::get('user', [AuthController::class, 'me']);

Route::get('customers', [CustomerController::class, 'index']);
Route::get('products', [ProductController::class, 'index']);
Route::post('coupons/validate', [CouponController::class, 'validateCode']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('orders', [OrderController::class, 'store']);
    Route::get('orders/my', [OrderController::class, 'my']);
    Route::get('orders/{order}', [OrderController::class, 'show']);
});
