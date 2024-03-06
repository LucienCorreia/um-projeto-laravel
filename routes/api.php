<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'products'], function () {
        Route::get('/', [\App\Http\Controllers\ProductController::class, 'index']);
    });

    Route::group(['prefix' => 'sales'], function () {
        Route::get('/', [\App\Http\Controllers\SaleController::class, 'index']);
        Route::get('/{sale}', [\App\Http\Controllers\SaleController::class, 'show']);
    });
});
