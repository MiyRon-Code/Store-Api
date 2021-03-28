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
    Route::get('/products', [Controllers\ProductController::class, 'index']);
});

Route::prefix('update')->group(function () {
    Route::post('/user', [Controllers\UserController::class, 'update']);
    Route::post('/category', [Controllers\CategoryController::class, 'update']);
    Route::post('/product', [Controllers\ProductController::class, 'update']);
});

Route::prefix('create')->group(function () {
    Route::post('/user', [Controllers\UserController::class, 'create']);
    Route::post('/category', [Controllers\CategoryController::class, 'create']);
    Route::post('/product', [Controllers\ProductController::class, 'create']);
});



