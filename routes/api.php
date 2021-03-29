<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
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



Route::prefix('get')->group(function () {
    Route::get('/users', [Controllers\UserController::class, 'index']);
    Route::get('/categories', [Controllers\CategoryController::class, 'index']);
    Route::get('/product/{id}', [Controllers\ProductController::class, 'byId']);
    Route::get('/products', [Controllers\ProductController::class, 'index']);
    Route::get('/products/category/{category_id}', [Controllers\ProductController::class, 'byCategoryId']);
    Route::middleware('auth:sanctum')->get('/orders', [Controllers\OrderController::class, 'index']);
    Route::middleware('auth:sanctum')->get('/my/orders', [Controllers\OrderController::class, 'myOrders']);
});

Route::middleware('isjson')->prefix('update')->group(function () {
    Route::post('/user', [Controllers\UserController::class, 'update']);
    Route::post('/category', [Controllers\CategoryController::class, 'update']);
    Route::post('/product', [Controllers\ProductController::class, 'update']);
    Route::post('/product/id', [Controllers\ProductController::class, 'update']);
    
});

Route::middleware('isjson')->prefix('create')->group(function () {
    Route::post('/user', [Controllers\UserController::class, 'create']);
    Route::post('/user/token', [Controllers\UserController::class, 'token']);
    Route::post('/category', [Controllers\CategoryController::class, 'create']);
    Route::post('/product', [Controllers\ProductController::class, 'create']);
    Route::middleware('auth:sanctum')->post('/order/{product_id}', [Controllers\OrderController::class, 'create']);
});

Route::get('/login', function(){
    return response()->json([
        'error' => 'you are not logged in. You need an authorization token get an authorization token', 
        'login path' => 'api/create/user/token'
    ],401);
})->name('login');




