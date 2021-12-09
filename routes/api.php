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

Route::group(['middleware' => ['apiJwt', 'checkUser'], 'prefix' => 'auth',], function ($router) {

    //User
    Route::middleware(['checkUserPermission'])->group(function () {
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

    //Order
    Route::middleware(['checkUserType'])->group(function () {
        Route::post('delivery-order', 'V1\\DeliveryOrderController@store');
    });

    Route::post('delivery-order/{id}', 'V1\\DeliveryOrderController@update');
    Route::get('delivery-order', 'V1\\DeliveryOrderController@index');
    Route::get('delivery-order/{id}', 'V1\\DeliveryOrderController@show');
    Route::get('order-seller/{id?}', 'V1\\DeliveryOrderController@showOrderSeller');

    //Notification
    Route::get('notification', 'V1\\NotificationController@index');
    Route::get('notification/{id}', 'V1\\NotificationController@show');
    Route::get('notification-read-done', 'V1\\NotificationController@notificationReadDone');
    Route::get('notification-read-not', 'V1\\NotificationController@notificationNotRead');
    
    //Integration Taximachine Delivery
    
    Route::get('estimate-delivery', 'V1\\EstimateDelivery@estimateDelivery');
});

Route::group(['prefix' => ''], function ($router) {
    //User
    Route::post('user', 'V1\\UserController@store');
    Route::post('login', 'V1\\AuthController@login');
    Route::get('example-weather/{id}', 'V1\\ExampleWeatherCotroller@show');

    //Category
    Route::get('category', 'V1\\CategoryController@index');
    Route::get('category/{id}', 'V1\\CategoryController@show');
    Route::get('category-seller/{id}', 'V1\\CategoryController@categoryWithseller');

    //Products
    Route::get('product/{id}', 'V1\\ProductController@show');

    //Seller
    Route::get('seller-products/{id}', 'V1\\SellerController@sellerWithProducts');
    Route::get('seller/{id}', 'V1\\SellerController@showSubCategoryWithProduct');
    Route::get('seller', 'V1\\SellerController@index');
});
