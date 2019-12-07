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

Route::post('login', 'UserController@login')->name('login');
Route::post('signup', 'UserController@signup')->name('signup');

Route::middleware('auth:api')->group(function () {
    Route::get('user', 'UserController@user')->name('user');

    Route::group(['prefix' => 'pulse', 'as' => 'pulse'], function () {
        Route::post('validation', 'HlrController@validation')->name('validation');
        Route::post('payment', 'HlrController@payment')->name('payment');
    });

    Route::get('logout', 'UserController@logout')->name('logout');
});
