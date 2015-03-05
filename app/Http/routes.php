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

Route::get('phpinfo', function(){
    return phpinfo();
});

Route::get('test', 'WelcomeController@test');

Route::get('/', 'IndexController@getIndex');

Route::get('home', 'HomeController@index');

Route::get('zakupka/{id}', 'PurchasesController@getPurchase');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

/**
 * Раздел "Админка"
 */
Route::group(['prefix' => 'admin'], function()
{
    Route::controllers([
        'widgets' => 'Admin\WidgetsController',
    ]);
});


/**
 * Раздел "Продавцы"
 */
Route::group(['prefix' => 'seller'], function()
{
    Route::post('media/upload', 'Seller\MediaController@postUpload');

    Route::get('attribute-group/{id}', 'Seller\AttributesController@getGroup');
    Route::get('product/{id}', 'Seller\ProductsController@getProduct');
    Route::get('product/delete/{id}', 'Seller\ProductsController@getDelete');

    Route::controllers([
        'auth' => 'Seller\AuthController',
        'products' => 'Seller\ProductsController',
        'pricing-grids' => 'Seller\PricingGridsController',
        'purchases' => 'Seller\PurchasesController',
        'prices' => 'Seller\PricesController',
        'attributes' => 'Seller\AttributesController',
        '/' => 'Seller\IndexController',
    ]);
});

/**
 * API
 */
Route::group(['prefix' => 'api'], function()
{
    Route::resource('model', 'Api\ModelController');
    Route::resource('catalog-tree', 'Api\CatalogTreeController');
});
