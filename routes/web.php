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
*/

Route::get('/', 'FeedbackController@create');
Route::get('/feedback', 'FeedbackController@index');
Route::post('/feedback/create', 'FeedbackController@store');
Route::get('/feedback/delete/{id}', 'FeedbackController@destroy');
