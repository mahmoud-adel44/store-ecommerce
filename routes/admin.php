<?php

use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

//----------------------------------------------------------
//note that there is prefix for all file routes
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {

    Route::group(['namespace' => 'Dashboard', 'middleware' => 'auth:admin' , 'prefix' => 'admin'], function () {

        Route::get('/', 'DashboardController@index')->name('admin.dashboard');//the first page admin will visited after be authenticated
        Route::get('logout', 'LoginController@logout')->name('admin.logout');

        Route::group(['prefix' => 'settings'], function () {
            Route::get('shipping-methods/{type}', 'SettingsController@editShippingMethods')->name('edit.shipping.methods');
            Route::put('shipping-methods/{id}', 'SettingsController@updateShippingMethods')->name('update.shippings.methods');
        });
        Route::group(['prefix' => 'profile'], function () {
            Route::get('edit', 'profileController@editProfile')->name('edit.profile');
            Route::put('update', 'profileController@updateProfile')->name('update.profile');
        });

    });

    Route::group(['namespace' => 'Dashboard', 'middleware' => 'guest:admin' , 'prefix' => 'admin'], function () {
        Route::get('login', 'LoginController@login')->name('admin.login');
        Route::post('login', 'LoginController@attempt')->name('admin.attempt');

    });
});
