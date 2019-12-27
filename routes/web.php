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

Route::get('/user/referral/{username}', 'ConfigController@Referral')->name('ref');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('/', 'UserController@index')->name('index')->middleware(['admin', 'auth']);
    Route::get('/create', 'UserController@create')->name('create');
    Route::post('/store', 'UserController@store')->name('store');
    Route::get('/show', 'UserController@show')->name('show')->middleware(['admin', 'auth']);
    Route::get('/edit/{id}', 'UserController@edit')->name('edit')->middleware(['admin', 'auth']);
    Route::post('/update/{id}', 'UserController@update')->name('update')->middleware(['admin', 'auth']);
    Route::get('/delete/{id}', 'UserController@destroy')->name('delete')->middleware(['admin', 'auth']);
});

Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('/', 'BeeController@index')->name('index')->middleware(['admin', 'auth']);
    Route::get('/show', 'BeeController@show')->name('show')->middleware(['admin', 'auth']);
    Route::get('/edit/{id}', 'BeeController@edit')->name('edit')->middleware(['admin', 'auth']);
    Route::post('/update/{id}', 'BeeController@update')->name('update')->middleware(['admin', 'auth']);
    Route::get('/delete/{id}', 'BeeController@destroy')->name('delete')->middleware(['admin', 'auth']);
});
