<?php

use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;

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

Route::post('login', 'ApiController@login');
Route::post('register', 'ApiController@register');



Route::post('board', 'BoardController@store');
Route::put('board/{board}', 'BoardController@update');
Route::delete('board/{board}', 'BoardController@destroy');



Route::post('project', 'ProjectController@store');
Route::get('project', 'ProjectController@index');
Route::get('project/{project}', 'ProjectController@show');
Route::put('project/{project}', 'ProjectController@update');
Route::delete('project/{project}', 'ProjectController@destroy');
