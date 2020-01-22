<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'referral', 'as' => 'referral.'], function () {
    Route::get('/{username}', 'ConfigController@index')->name('index');
    Route::post('/store', 'ConfigController@store')->name('store');
    Route::get('/show/{id}', 'ConfigController@show')->name('show');
    Route::post('/update', 'ConfigController@update')->name('update');
    Route::get('/delete/{id}', 'ConfigController@destroy')->name('delete');
});

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
    Route::post('/store', 'BeeController@store')->name('store')->middleware('auth', 'role:0');
    Route::get('/show/{id}', 'BeeController@show')->name('show')->middleware('auth', 'role:0');
    Route::get('/{id}/update/{status}', 'BeeController@update')->name('update')->middleware('auth', 'role:0');
    Route::get('/delete/{id}', 'BeeController@destroy')->name('delete')->middleware('auth', 'role:0');
    Route::post('/qr', 'BeeController@QRCodeList')->name('QRCodeList')->middleware('auth', 'role:0');
    Route::get('/qr/{id}', 'BeeController@QRCode')->name('QRCode')->middleware('auth', 'role:0');
});

Route::group(['prefix' => 'ledger', 'as' => 'ledger.'], function () {
    Route::get('/', 'LedgerController@index')->name('index')->middleware('auth', 'role:0|1');
    Route::get('/create', 'LedgerController@create')->name('create')->middleware('auth', 'role:0|1');
    Route::post('/store', 'LedgerController@store')->name('store')->middleware('auth', 'role:0|1');
    Route::get('/show/{id}', 'LedgerController@show')->name('show')->middleware('auth', 'role:0|1');
    Route::get('/edit/{id}', 'LedgerController@edit')->name('edit')->middleware('auth', 'role:0|1');
    Route::post('/update/{id}', 'LedgerController@update')->name('update')->middleware('auth', 'role:0|1');
    Route::get('/delete/{id}', 'LedgerController@destroy')->name('delete')->middleware('auth', 'role:0');
});

Route::group(['prefix' => 'withdraw', 'as' => 'withdraw.'], function () {
    Route::get('/', 'WithdrawController@index')->name('index')->middleware('auth', 'role:0|1');
    Route::get('/{id}/update/{status}', 'WithdrawController@update')->name('update')->middleware('auth', 'role:0');
});

Route::group(['prefix' => 'binary', 'as' => 'binary.'], function () {
    Route::get('/', 'BinaryController@index')->name('index')->middleware('auth', 'role:0|1');
    Route::get('/find/{id}', 'BinaryController@show')->name('show')->middleware('auth', 'role:0|1');
});
