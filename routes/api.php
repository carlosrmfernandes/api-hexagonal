<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['apiJwt', 'checkUserType'], 'prefix' => 'auth',], function ($router) {

    //User
    Route::middleware(['checkUser'])->group(function () {
        Route::post('user/{id}', 'V1\\UserController@update');
        Route::get('user/{id}', 'V1\\UserController@show');
    });

    //User Type
    Route::middleware(['blockRoute'])->group(function () {
        Route::post('user-type', 'V1\\UserTypeController@store');
        Route::post('user-type/{id}', 'V1\\UserTypeController@update');

        Route::get('user-type/{id}', 'V1\\UserTypeController@show');
        Route::get('user-type', 'V1\\UserTypeController@index');
    });

    //Products
    Route::post('product', 'V1\\ProductController@store');
    Route::post('product/{id}', 'V1\\ProductController@update');

    //Delivery Order
    Route::post('delivery-order', 'V1\\DeliveryOrderController@store');
    Route::get('delivery-order', 'V1\\DeliveryOrderController@index');
    Route::get('delivery-order/{id}', 'V1\\DeliveryOrderController@show');
    Route::post('delivery-order/{id}', 'V1\\DeliveryOrderController@update');
});

Route::group(['prefix' => ''], function ($router) {
    //User
    Route::post('user', 'V1\\UserController@store');
    Route::post('login', 'V1\\AuthController@login');
    Route::get('example-weather/{id}', 'V1\\ExampleWeatherCotroller@show');

    //Category
    Route::get('category', 'V1\\CategoryController@index');
    Route::get('category/{id}', 'V1\\CategoryController@show');
    Route::get('category-establishment/{id}', 'V1\\CategoryController@categoryWithEstablishment');

    //Products
    Route::get('product/{id}', 'V1\\ProductController@show');

    //Establishment
    Route::get('establishment/{id}', 'V1\\EstablishmentController@showSubCategoryWithProduct');
    Route::get('establishment', 'V1\\EstablishmentController@index');
});
