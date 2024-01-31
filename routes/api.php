<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::get('users', 'API\UserController@index');
Route::post('users/store', 'API\UserController@store');
Route::get('users/show/{id}', 'API\UserController@show');
Route::post('users/update', 'API\UserController@update');
Route::post('users/destroy/{id}', 'API\UserController@destroy');

Route::get('cars', 'API\CarController@index');
Route::post('cars/store', 'API\CarController@store');
Route::get('cars/show/{id}', 'API\CarController@show');
Route::post('cars/update', 'API\CarController@update');
Route::post('cars/destroy/{id}', 'API\CarController@destroy');


