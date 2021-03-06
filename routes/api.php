<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\SellerCotroller;

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
    Route::get('/users/all', [Controllers\UserController::class, 'indexAll']);
    Route::get('/user/{user_id}', [Controllers\UserController::class, 'byId']);
    Route::get('/sellers', [Controllers\SellerCotroller::class, 'index']);
    Route::get('/seller/{seller_id}', [Controllers\SellerCotroller::class, 'byId']);
    Route::get('/categories', [Controllers\CategoryController::class, 'index']);
    Route::get('/category/{category_id}', [Controllers\CategoryController::class, 'byId']);
    Route::get('/category/{category_id}/products', [Controllers\CategoryController::class, 'products']);
    Route::get('/products', [Controllers\ProductController::class, 'index']);
    Route::get('/product/{product_id}', [Controllers\ProductController::class, 'byId']);
    Route::middleware('auth:sanctum')->get('/orders', [Controllers\OrderController::class, 'index']);
    Route::middleware('auth:sanctum')->get('/my/orders', [Controllers\OrderController::class, 'myOrders']);
    Route::middleware('auth:sanctum')->get('/orders/confirmed', [Controllers\OrderController::class, 'confirmed']);
    Route::middleware('auth:sanctum')->get('/orders/unconfirmed', [Controllers\OrderController::class, 'unconfirmed']);
});

Route::middleware('isjson')->prefix('create')->group(function () {
    Route::post('/user', [Controllers\UserController::class, 'create']);
    Route::post('/user/token', [Controllers\UserController::class, 'token']);
    Route::post('/seller', [Controllers\SellerCotroller::class, 'create']);
    Route::post('/category', [Controllers\CategoryController::class, 'create']);
    Route::post('/product', [Controllers\ProductController::class, 'create']);
    Route::middleware('auth:sanctum')->post('/order/{product_id}', [Controllers\OrderController::class, 'create'])->withoutMiddleware('isjson');;
});

Route::middleware('isjson')->prefix('update')->group(function () {
    Route::post('/user/{user_id}', [Controllers\UserController::class, 'update']);
    Route::post('/seller/{seller_id}',[Controllers\SellerCotroller::class, 'update']);
    Route::post('/category/{category_id}', [Controllers\CategoryController::class, 'update']);
    Route::post('/product/{prosuct_id}', [Controllers\ProductController::class, 'update']);
    Route::post('/order/{order_id}', [Controllers\OrderController::class, 'update']);
});

Route::prefix('delete')->group(function () {
    Route::get('/user/{user_id}', [Controllers\UserController::class, 'delete']);
    Route::middleware('auth:sanctum')->get('/token', [Controllers\UserController::class, 'tokenDelete']);
    Route::get('/seller/{user_id}', [Controllers\SellerCotroller::class, 'delete']);
    Route::get('/category/{category_id}', [Controllers\CategoryController::class, 'delete']); 
    Route::get('/product/{product_id}', [Controllers\ProductController::class, 'delete']); 
    Route::get('/products', [Controllers\ProductController::class, 'deleteAll']);
    Route::get('/products/category/{category_id}', [Controllers\ProductController::class, 'deleteAllbyCategory']);
    Route::middleware('auth:sanctum')->get('/order/{order_id}', [Controllers\OrderController::class, 'delete']);
    Route::middleware('auth:sanctum')->get('/my/orders', [Controllers\OrderController::class, 'deleteMyOrders']);
    Route::middleware('auth:sanctum')->get('/orders', [Controllers\OrderController::class, 'deleteAll']);
});

Route::prefix('destroy')->group(function () {
    Route::get('/user/{user_id}', [Controllers\UserController::class, 'destroy']);
    Route::get('/seller/{user_id}', [Controllers\SellerCotroller::class, 'destroy']);
    Route::get('/category/{category_id}', [Controllers\CategoryController::class, 'destroy']);
    Route::get('/product/{id}', [Controllers\ProductController::class, 'destroy']); 
    Route::get('/products', [Controllers\ProductController::class, 'destroyAll']);
    Route::get('/products/category/{category_id}', [Controllers\ProductController::class, 'destroyAllbyCategory']);
    Route::middleware('auth:sanctum')->get('/order/{order_id}', [Controllers\OrderController::class, 'destroy']);
    Route::middleware('auth:sanctum')->get('/my/orders', [Controllers\OrderController::class, 'destroyMyOrders']);
    Route::middleware('auth:sanctum')->get('/orders', [Controllers\OrderController::class, 'destroyAll']);
 
});

Route::get('/login', function(){
    return response()->json([
        'error' => 'you are not logged in. You need an authorization token get an authorization token', 
        'login path' => 'api/create/user/token'
    ],401);
})->name('login');




