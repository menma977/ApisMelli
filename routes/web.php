<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
| , 'middleware' => ['rule', 'auth']
 */

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user/referral/{username}', 'ConfigController@Referral')->name('ref');

Auth::routes();

Route::group(['prefix' => 'home', 'as' => 'home.'], function () {
    Route::get('/', 'HomeController@index')->name('index');
});

Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('/', 'UserController@index')->name('index')->middleware(['rule', 'auth']);
    Route::get('/create', 'UserController@create')->name('create');
    Route::post('/store', 'UserController@store')->name('store');
    Route::get('/show', 'UserController@show')->name('show');
    Route::get('/edit/{id}', 'UserController@edit')->name('edit');
    Route::post('/update/{id}', 'UserController@update')->name('update');
    Route::get('/delete/{id}', 'UserController@destroy')->name('delete')->middleware(['rule', 'auth']);
    Route::group(['prefix' => 'password', 'as' => 'password.'], function () {
        Route::get('/edit', 'UserController@editPassword')->name('edit');
        Route::post('/update', 'UserController@updatePassword')->name('update');
    });
});

Route::group(['prefix' => 'bee', 'as' => 'bee.'], function () {
    Route::get('/', 'BeeController@index')->name('index');
    Route::get('/create', 'BeeController@create')->name('create')->middleware(['rule', 'auth']);
    Route::post('/store', 'BeeController@store')->name('store')->middleware(['rule', 'auth']);
    Route::get('/show', 'BeeController@show')->name('show')->middleware(['rule', 'auth']);
    Route::get('/edit/{id}', 'BeeController@edit')->name('edit')->middleware(['rule', 'auth']);
    Route::post('/update/{id}', 'BeeController@update')->name('update')->middleware(['rule', 'auth']);
    Route::get('/delete/{id}', 'BeeController@destroy')->name('delete')->middleware(['rule', 'auth']);
});

Route::group(['prefix' => 'ledger', 'as' => 'ledger.'], function () {
    Route::get('/', 'LedgerController@index')->name('index');
    Route::get('/create', 'LedgerController@create')->name('create')->middleware(['rule', 'auth']);
    Route::post('/store', 'LedgerController@store')->name('store')->middleware(['rule', 'auth']);
    Route::get('/show', 'LedgerController@show')->name('show')->middleware(['rule', 'auth']);
    Route::get('/edit/{id}', 'LedgerController@edit')->name('edit')->middleware(['rule', 'auth']);
    Route::post('/update/{id}', 'LedgerController@update')->name('update');
    Route::get('/delete/{id}', 'LedgerController@destroy')->name('delete');
});

Route::group(['prefix' => 'history', 'as' => 'history.'], function () {
    Route::get('/', 'BuyHistoryController@index')->name('index');
    Route::get('/create', 'BuyHistoryController@create')->name('create');
    Route::post('/store', 'BuyHistoryController@store')->name('store');
    Route::get('/show', 'BuyHistoryController@show')->name('show');
    Route::get('/edit/{id}', 'BuyHistoryController@edit')->name('edit');
    Route::post('/update/{id}', 'BuyHistoryController@update')->name('update');
    Route::get('/delete/{id}', 'BuyHistoryController@destroy')->name('delete');
});

Route::group(['prefix' => 'binary', 'as' => 'binary.'], function () {
    Route::get('/', 'BinaryController@index')->name('index');
    Route::get('/create', 'BinaryController@create')->name('create');
    Route::post('/store', 'BinaryController@store')->name('store');
    Route::get('/show', 'BinaryController@show')->name('show');
    Route::get('/edit/{id}', 'BinaryController@edit')->name('edit');
    Route::post('/update/{id}', 'BinaryController@update')->name('update');
    Route::get('/delete/{id}', 'BinaryController@destroy')->name('delete');
});
