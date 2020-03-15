<?php

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



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/translate', 'TranslateController@show')->name('translate.show');
Route::get('/translate/add', 'TranslateController@add')->name('translate.add');

Route::get('/', 'TranslateController@show');

Route::post('/translate/add', 'TranslateController@postAdd')->name('translate.add');


