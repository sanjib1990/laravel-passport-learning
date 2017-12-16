<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['client'])->get('tasks', 'TaskController@index');

Route::group(['prefix' => 'mains', 'middleware' => 'auth:api'], function () {
    Route::get('/{main?}', 'MainController@index')->middleware('scope:read');
    Route::post('/', 'MainController@index')->middleware('scope:write');
    Route::put('/{main}', 'MainController@update')->middleware('scope:update');
    Route::delete('/{main}', 'MainController@destroy')->middleware('scope:delete');
});
