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

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

Route::post('login', 'Api\UserController@login');
Route::get('boot/login/{id}/{apiToken}/{routeTarget}', 'Api\UserController@AutoLogin');
Route::post('register', 'Api\UserController@register');
Route::post('upload/image/user', 'Api\UserController@uploadImage');
Route::post('user/upload/image/ktp', 'Api\UserController@uploadImageKTP');

Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('/store', 'BeeController@store')->name('store');
});

Route::middleware('auth:api')->group(function () {
    Route::get('user/profile', 'Api\UserController@profile');
    Route::get('user/bank', 'Api\UserController@bank');
    Route::post('user/update', 'Api\UserController@update');
    Route::post('user/update/image', 'Api\UserController@updateImage');
    Route::post('user/upload/payment', 'Api\UserController@uploadPayment');
});
