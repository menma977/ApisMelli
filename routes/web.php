<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user/referral/{username}', 'ConfigController@Referral')->name('ref');

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

// role : 0 = Admin, 1 = Member

Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('/', 'UserController@index')->name('index')->middleware('auth', 'role:0');
    Route::get('/create', 'UserController@create')->name('create')->middleware('auth', 'role:0|1');
    Route::post('/store', 'UserController@store')->name('store')->middleware('auth', 'role:0|1');
    Route::get('/show/{id}', 'UserController@show')->name('show')->middleware('auth', 'role:0|1');
    Route::get('/edit/{id}', 'UserController@edit')->name('edit')->middleware('auth', 'role:0|1');
    Route::post('/update/{id}', 'UserController@update')->name('update')->middleware('auth', 'role:0|1');
    Route::get('/delete/{id}', 'UserController@destroy')->name('delete')->middleware('auth', 'role:0');
});

Route::group(['prefix' => 'bee', 'as' => 'bee.'], function () {
    Route::get('/', 'BeeController@index')->name('index')->middleware('auth', 'role:0');
    Route::get('/create', 'BeeController@create')->name('create')->middleware('auth', 'role:0');
    Route::post('/store', 'BeeController@store')->name('store')->middleware('auth', 'role:0');
    Route::get('/show/{id}', 'BeeController@show')->name('show')->middleware('auth', 'role:0');
    Route::get('/edit/{id}', 'BeeController@edit')->name('edit')->middleware('auth', 'role:0');
    Route::post('/update/{id}', 'BeeController@update')->name('update')->middleware('auth', 'role:0');
    Route::get('/delete/{id}', 'BeeController@destroy')->name('delete')->middleware('auth', 'role:0');
    Route::get('/qr/{id}', 'BeeController@QRCode')->name('QRCode')->middleware('auth', 'role:0');
});
