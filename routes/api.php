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
/*

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
/***************** Auth *******************************/
Route::group(['prefix' => 'auth',], function () {
    Route::post('login', 'UsersController@login');
    Route::post('register', 'UsersController@register');
    Route::post('forget_password', 'UsersController@forget_password');
    Route::post('check_reset_code', 'UsersController@check_reset_code');
    Route::post('reset_password', 'UsersController@reset_password');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('details', 'UsersController@details');
        Route::post('logout', 'UsersController@logout');
        Route::post('change_password', 'UsersController@change_password');
    });
});

/**************** home *******************************/
Route::group(['prefix' => 'home',], function() {
    Route::get('install', 'HomeController@install');
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('providers', 'HomeController@providers');

    });
});

/************* category ***********************************/
Route::group(['prefix' => 'category'], function() {
    Route::get('show_all', 'CategoryController@index');
    Route::post('store', 'CategoryController@store');
    Route::get('show', 'CategoryController@show');
    Route::post('destroy', 'CategoryController@destroy');
    Route::post('update', 'CategoryController@update');
});

/************ advertisment *********************/
Route::group(['prefix'=>'advertisment'], function (){
    Route::get('show_all', 'AdvertismentController@index');
});



