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

//header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization');
//header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');

Route::post('login', 'Api\ConfigController@login');
Route::post('register', 'Api\ConfigController@register');

Route::group(['prefix' => 'notify', 'as' => 'notify.'], function () {
  Route::get('/', 'NotificationController@index')->name('index');
  Route::post('/store', 'NotificationController@store')->name('store');
  Route::post('/update/{id}', 'NotificationController@update')->name('update');
  Route::post('/destroy/{id}', 'NotificationController@destroy')->name('destroy');
});

//Route::group(['prefix' => 'cron', 'as' => 'cron.'], function () {
//  Route::get('run', 'Api\CronJobController@run')->name('run');
//});

Route::middleware('auth:api')->group(function () {
  Route::get('verification', 'Api\ConfigController@verification');

  Route::get('logout', 'Api\ConfigController@logout');

  Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('show', 'Api\ConfigController@show')->name('show');
    Route::get('balance', 'Api\ConfigController@balance')->name('balance');
    Route::post('update', 'Api\ConfigController@update')->name('update');
    Route::post('update/profile/image', 'Api\ConfigController@updateProfile')->name('updateProfile');
    Route::post('update/profile/data', 'Api\ConfigController@updateData')->name('updateData');
  });

  Route::group(['prefix' => 'withdraw', 'as' => 'withdraw.'], function () {
    Route::get('show', 'Api\ConfigController@withdrawValidate')->name('show');
    Route::post('store', 'Api\ConfigController@withdraw')->name('store');
  });

  Route::group(['prefix' => 'stup', 'as' => 'stup.'], function () {
    Route::post('show', 'Api\ConfigController@checkSetup')->name('show');
    Route::post('store', 'Api\ConfigController@requestStup')->name('store');
  });
});
