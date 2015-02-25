<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	'admin/widgets' => 'Admin\WidgetsController',
]);

/**
 * Раздел "Продавцы"
 */
Route::group(['prefix' => 'seller'], function()
{

    Route::controllers([
        'auth' => 'Seller\AuthController',
        'products' => 'Seller\ProductsController',
        'pricing-grids' => 'Seller\PricingGridsController',
        '/' => 'Seller\IndexController',
    ]);

});
