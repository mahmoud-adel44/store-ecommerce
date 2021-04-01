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
Route::group(['namespace' => 'Dashboard' , 'middleware' => 'auth:admin'] , function (){
  Route::get('/' , 'DashboardController@index')->name('admin.dashboard');//the first page admin will visited after be authenticated
});

Route::group(['namespace' => 'Dashboard', 'middleware' => 'guest:admin' ] , function (){
    Route::get('login' , 'LoginController@login')->name('admin.login');
    Route::post('login', 'LoginController@attempt')->name('admin.attempt');

});

