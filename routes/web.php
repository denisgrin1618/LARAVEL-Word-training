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
//Route::get('/', 'QuizController@start');
Route::get('/', 'QuizController@start');


Route::get('/translation', 'TranslationController@show')->name('translation.show');
Route::post('/translation/add', 'TranslationController@add')->name('translation.add');
Route::post('/translation/edit', 'TranslationController@edit')->name('translation.edit');
Route::get('/translation/search', 'TranslationController@search')->name('translation.search');
Route::delete('/translation/delete/{id}', 'TranslationController@destroy')->name('translation.destroy');

Route::get('/quiz', 'QuizController@start')->name('quiz.start');
Route::post('/quiz/store', 'QuizController@store')->name('quiz.store');
Route::get('/quiz/{id}', 'QuizController@show')->name('quiz.id');

Route::post('/statistics/store', 'StatisticsController@store')->name('statistics.store');
