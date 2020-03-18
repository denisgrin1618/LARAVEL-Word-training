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
Route::get('/', 'HomeController@index');

Route::get('/translate', 'TranslateController@show')->name('translate.show');
Route::post('/translate/add', 'TranslateController@add')->name('translate.add');
Route::post('/translate/edit', 'TranslateController@edit')->name('translate.edit');
Route::delete('/translate/delete/{id}', 'TranslateController@destroy')->name('translate.destroy');


