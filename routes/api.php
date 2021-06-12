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
    Route::get('product/{id}', 'V1\\ProductController@show');
    Route::post('product/{id}', 'V1\\ProductController@update');

    //Category
    Route::get('category', 'V1\\CategoryController@index');
    Route::get('category/{id}', 'V1\\CategoryController@show');

    //Establishment
    Route::get('establishment/{id}', 'V1\\EstablishmentController@show');
    Route::get('establishment', 'V1\\EstablishmentController@index');

    //Delivery Order
    Route::post('delivery-order', 'V1\\DeliveryOrderController@store');
    Route::get('delivery-order', 'V1\\DeliveryOrderController@index');
    Route::get('delivery-order/{id}', 'V1\\DeliveryOrderController@show');
    Route::post('delivery-order/{id}', 'V1\\DeliveryOrderController@update');

    //Customer
    Route::get('customers/{id}', 'V1\\MercadoPagoCotroller@showCustomer');
    Route::get('customers/{customer_id}/cards', 'V1\\MercadoPagoCotroller@showCards');
    Route::post('customers', 'V1\\MercadoPagoCotroller@storeCustomer');
    Route::post('customers/{customer_id}/cards', 'V1\\MercadoPagoCotroller@storeCard');
    Route::delete('customers/{customer_id}/cards', 'V1\\MercadoPagoCotroller@deleteCard');

    //Payment
    Route::post('payment', 'V1\\MercadoPagoCotroller@storePayment');

});

Route::group(['prefix' => ''], function ($router) {
    Route::post('user', 'V1\\UserController@store');
    Route::post('login', 'V1\\AuthController@login');
    Route::get('example-weather/{id}', 'V1\\ExampleWeatherCotroller@show');
    Route::get('indetification-types', 'V1\\MercadoPagoCotroller@showIdentificationType');
});
