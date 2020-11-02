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

Route::get('/teams', 'API\TeamController@index');
Route::get('/teams/{id}', 'API\TeamController@detail');
Route::post('/teams', 'API\TeamController@store');
Route::delete('/teams/{id}', 'API\TeamController@destroy');

Route::post('/players', 'API\PlayerController@store');
Route::put('/players/{id}', 'API\PlayerController@update');
Route::delete('/players/{id}', 'API\PlayerController@destroy');
