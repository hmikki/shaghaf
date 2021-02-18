<?php

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

Route::group([
    'prefix' => 'auth',
], function () {
    Route::post('login','AuthController@login');
    Route::post('register','AuthController@register');
    Route::post('forget_password','AuthController@forget_password');
    Route::post('check_reset_code','AuthController@check_reset_code');
    Route::post('reset_password','AuthController@reset_password');
    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('me','AuthController@show');
        Route::post('refresh','AuthController@refresh');
        Route::post('update','AuthController@update');
        Route::get('resend_verify', 'AuthController@resend_verify');
        Route::post('verify', 'AuthController@verify');
        Route::post('change_password','AuthController@change_password');
        Route::post('logout','AuthController@logout');
    });
});
Route::group([
    'middleware' => 'auth:api'
], function() {
    Route::group([
        'prefix' => 'notifications',
    ], function() {
        Route::get('/', 'NotificationController@index');
        Route::post('send', 'NotificationController@send');
        Route::post('read', 'NotificationController@read');
        Route::post('read/all', 'NotificationController@read_all');
    });

    Route::group([
        'prefix' => 'transactions',
    ], function() {
        Route::get('/', 'TransactionController@index');
        Route::get('my_balance', 'TransactionController@my_balance');
        Route::post('generate_checkout', 'TransactionController@generate_checkout');
        Route::get('check_payment', 'TransactionController@check_payment');
    });
    Route::group([
        'prefix' => 'tickets',
    ], function() {
        Route::get('/','TicketController@index');
        Route::get('show','TicketController@show');
        Route::post('store','TicketController@store');
        Route::post('response','TicketController@response');
    });
    Route::group([
        'prefix' => 'products',
    ], function() {
        Route::get('/','ProductController@index');
        Route::get('show','ProductController@show');
        Route::post('store','ProductController@store');
        Route::post('update','ProductController@update');
        Route::post('destroy','ProductController@destroy');
    });

    Route::group([
        'prefix' => 'orders'
    ], function (){
        Route::get('/','OrderController@index');
        Route::get('show','OrderController@show');
        Route::post('store','OrderController@store');
        Route::post('update', 'OrderController@update');
        Route::post('review', 'OrderController@review');
    });
    Route::group([
        'prefix' => 'portfolios',
    ], function (){
        Route::get('/','PortfolioController@index');
        Route::get('show','PortfolioController@show');
        Route::post('store','PortfolioController@store');
        Route::post('update', 'PortfolioController@update');
        Route::post('destroy', 'PortfolioController@destroy');
    });
});

Route::group([
    'prefix' => 'home',
], function() {
    Route::get('install','HomeController@install');
    Route::get('faqs','HomeController@faqs');
    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('get_freelancers','HomeController@get_freelancers');
    });
});

