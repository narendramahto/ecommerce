<?php

use App\Http\Controllers\AddressController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CouponCodeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Product routes
Route::get('products', [ProductController::class, 'index']);
Route::get('products/{id}', [ProductController::class, 'show']);

// Cart routes
Route::post('cart/add', [CartController::class, 'add'])->middleware('auth:sanctum');
Route::get('cart', [CartController::class, 'index'])->middleware('auth:sanctum');


// Checkout routes
Route::get('coupon-list',[CouponCodeController::class,'couponList'])->middleware('auth:sanctum');
Route::post('checkout',[CouponCodeController::class,'checkout'])->middleware('auth:sanctum');

//Address
Route::post('address/add',[AddressController::class,'store'])->middleware('auth:sanctum');

//Placeorder
Route::post('place-order',[OrderController::class,'store'])->middleware('auth:sanctum');


//Route::post('checkout', [OrderController::class, 'checkout'])->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
