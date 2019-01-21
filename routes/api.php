<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
    // return $request->user();

    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');

    Route::prefix('/')
          //->middleware('auth:api')
          ->group(function () {

            Route::prefix('/order')
            ->group(function () {

                Route::get('/{id}', 'OrderController@item');
                Route::get('/', 'OrderController@collection');
                Route::post('/', 'OrderController@create');
                Route::patch('/{id}', 'OrderController@update');
                Route::delete('/{id}', 'OrderController@delete');
            });

            Route::prefix('/product')
            ->group(function () {

                Route::get('/{id}', 'ProductController@item');
                Route::get('/', 'ProductController@collection');
                Route::post('/', 'ProductController@create');
                Route::patch('/{id}', 'ProductController@update');
                Route::delete('/{id}', 'ProductController@delete');
            });

            Route::prefix('/user')
            ->group(function () {

                Route::get('/{id}', 'UserController@item');
                Route::get('/', 'UserController@collection');
                Route::post('/', 'UserController@create');
                Route::patch('/{id}', 'UserController@update');
                Route::delete('/{id}', 'UserController@delete');
            });

            Route::prefix('/delivery')
            ->group(function () {

                Route::get('/{id}', 'DeliveryController@item');
                Route::get('/', 'DeliveryController@collection');
                Route::post('/', 'DeliveryController@create');
                Route::patch('/{id}', 'DeliveryController@update');
                Route::delete('/{id}', 'DeliveryController@delete');
            });

            Route::prefix('/payment')
            ->group(function () {

                Route::get('/{id}', 'PaymentController@item');
                Route::get('/', 'PaymentController@collection');
                Route::post('/', 'PaymentController@create');
                Route::patch('/{id}', 'PaymentController@update');
                Route::delete('/{id}', 'PaymentController@delete');
            });

            Route::prefix('/vendor')
            ->group(function () {

                Route::get('/{id}', 'VendorController@item');
                Route::get('/', 'VendorController@collection');
                Route::post('/', 'VendorController@create');
                Route::patch('/{id}', 'VendorController@update');
                Route::delete('/{id}', 'VendorController@delete');
            });

            Route::prefix('/delivery')
            ->group(function () {

                Route::get('/{id}', 'DeliveryController@item');
                Route::get('/', 'DeliveryController@collection');
                Route::post('/', 'DeliveryController@create');
                Route::patch('/{id}', 'DeliveryController@update');
                Route::delete('/{id}', 'DeliveryController@delete');
            });

            Route::prefix('/page')
            ->group(function () {

                Route::get('/{id}', 'PageController@item');
                Route::get('/', 'PageController@collection');
                Route::post('/', 'PageController@create');
                Route::patch('/{id}', 'PageController@update');
                Route::delete('/{id}', 'PageController@delete');
            });

            Route::prefix('/currency')
            ->group(function () {

                Route::get('/{id}', 'CurrencyController@item');
                Route::get('/', 'CurrencyController@collection');
                Route::post('/', 'CurrencyController@create');
                Route::patch('/{id}', 'CurrencyController@update');
                Route::delete('/{id}', 'CurrencyController@delete');
            });

            Route::prefix('/image')
            ->group(function () {

                Route::get('/{id}', 'ImageController@item');
                Route::get('/', 'ImageController@collection');
                Route::post('/', 'ImageController@create');
                Route::patch('/{id}', 'ImageController@update');
                Route::delete('/{id}', 'ImageController@delete');
            });

            Route::prefix('/video')
            ->group(function () {

                Route::get('/{id}', 'VideoController@item');
                Route::get('/', 'VideoController@collection');
                Route::post('/', 'VideoController@create');
                Route::patch('/{id}', 'VideoController@update');
                Route::delete('/{id}', 'VideoController@delete');
            });

            Route::prefix('/collection')
            ->group(function () {

                Route::get('/{id}', 'CollectionController@item');
                Route::get('/', 'CollectionController@collection');
                Route::post('/', 'CollectionController@create');
                Route::patch('/{id}', 'CollectionController@update');
                Route::delete('/{id}', 'CollectionController@delete');
            });

            Route::prefix('/property')
            ->group(function () {

                Route::get('/{id}', 'PropertyController@item');
                Route::get('/', 'PropertyController@collection');
                Route::post('/', 'PropertyController@create');
                Route::patch('/{id}', 'PropertyController@update');
                Route::delete('/{id}', 'PropertyController@delete');
            });

            Route::prefix('/category')
            ->group(function () {

                Route::get('/{id}', 'CategoryController@item');
                Route::get('/', 'CategoryController@collection');
                Route::post('/', 'CategoryController@create');
                Route::patch('/{id}', 'CategoryController@update');
                Route::delete('/{id}', 'CategoryController@delete');
            });

            Route::prefix('/faq')
            ->group(function () {

                Route::get('/{id}', 'FAQController@item');
                Route::get('/', 'FAQController@collection');
                Route::post('/', 'FAQController@create');
                Route::patch('/{id}', 'FAQController@update');
                Route::delete('/{id}', 'FAQController@delete');
            });
          });
// });
