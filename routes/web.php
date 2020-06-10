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

Route::get('/locale/{locale}', 'LocaleController@setLocale')->name('locale.setlocale');



Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'QuizController@start');

Route::get('/profile', 'UserController@profile')->name('profile');
Route::post('/profile', 'UserController@update_avatar');


Route::get('/translation', 'TranslationController@show')->name('translation.show');
Route::get('/translation/import/{spreadsheet_id?}', 'TranslationController@import')->name('translation.import');
Route::post('/translation/importprogress', 'TranslationController@importProgess')->name('translation.importprogress');
Route::post('/translation/importpost', 'TranslationController@importPost')->name('translation.postimport');
Route::post('/translation/add', 'TranslationController@add')->name('translation.add');
Route::get('/translation/search', 'TranslationController@search')->name('translation.search');
Route::delete('/translation/delete/{id}', 'TranslationController@destroy')->name('translation.destroy');
Route::post('/translation/edit', 'TranslationController@edit')->name('translation.edit');

Route::get('/quiz/start', 'QuizController@start')->name('quiz.start');
Route::get('/quiz', 'QuizController@show_all')->name('quiz.show_all');
Route::get('/quiz/{id}', 'QuizController@show')->name('quiz.id');
Route::post('/quiz/store', 'QuizController@store')->name('quiz.store');
Route::delete('/quiz/delete/{id}', 'QuizController@destroy')->name('quiz.destroy');

Route::post('/statistics/store', 'StatisticsController@store')->name('statistics.store');
Route::get('/statistics', 'StatisticsController@show')->name('statistics.show');
