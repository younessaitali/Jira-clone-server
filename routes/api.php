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
Route::get('logout', 'ApiController@logout')->middleware('auth.jwt');
Route::post('refresh', 'ApiController@refresh')->middleware('auth.jwt');
Route::post('me', 'ApiController@me')->middleware('auth.jwt');




Route::post('board', 'BoardController@store');
Route::put('board/{board}', 'BoardController@update');
Route::delete('board/{board}', 'BoardController@destroy');



Route::post('task', 'TaskController@store');
Route::put('task/{task}', 'TaskController@update');
Route::delete('task/{task}', 'TaskController@destroy');


Route::post('todos', 'TodosContainerController@store');
Route::put('todos/{todosContainer}', 'TodosContainerController@update');
Route::delete('todos/{todosContainer}', 'TodosContainerController@destroy');



Route::post('todo', 'TodoController@store');
Route::put('todo/{todo}', 'TodoController@update');
Route::delete('todo/{todo}', 'TodoController@destroy');



Route::post('project', 'ProjectController@store');
Route::get('project', 'ProjectController@index');
Route::get('project/{project}', 'ProjectController@show');
Route::put('project/{project}', 'ProjectController@update');
Route::delete('project/{project}', 'ProjectController@destroy');



Route::post('project_Owner', 'ProjectOwnerController@store');
Route::delete('project_Owner', 'ProjectOwnerController@destroy');
