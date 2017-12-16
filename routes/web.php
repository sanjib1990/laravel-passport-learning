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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/task', 'TaskController');

// personal access token
Route::post('/personal/token', 'HomeController@generatePersonalToken');

// Authorization grant
Route::get('/redirect', 'HomeController@redirect');
Route::any('/auth/callback', 'HomeController@callback');

// Implicit grant
Route::get('/implicit', 'HomeController@implicitRedirect');
Route::any('/auth/implicit/callback', 'HomeController@implicitCallback');

