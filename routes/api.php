<?php

use Illuminate\Support\Facades\Route;
use Presentation\Api\Controllers\V1\AuthController;
use Presentation\Api\Controllers\V1\UserController;
use Presentation\Api\Controllers\V1\BookController;
use Presentation\Api\Controllers\V1\StoreController;

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

Route::get('/', function () {
    echo "api rodando";
});

Route::group(['middleware' => ['apiJwt'], 'prefix' => 'auth',], function ($router) {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('user/{id}', [UserController::class, 'show']);

    Route::post('book', [BookController::class, 'store']);
    Route::get('book', [BookController::class, 'getAll']);
    Route::put('book/{id}', [BookController::class, 'update']);
    Route::delete('book/{id}', [BookController::class, 'delete']);

    Route::post('store', [StoreController::class, 'store']);
    Route::get('store', [StoreController::class, 'getAll']);
    Route::put('store/{id}', [StoreController::class, 'update']);
    Route::delete('store/{id}', [StoreController::class, 'delete']);

});

Route::group(['prefix' => ''], function ($router) {
    Route::post('user', [UserController::class, 'store']);
    Route::post('login', [AuthController::class, 'login']);
});
