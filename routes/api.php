<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\News;

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

Route::get('/getusers/', 'UserController@getUsers');
Route::post('/addusers/', 'UserController@addUsers');
Route::patch('/updateusers/', 'UserController@updateUsers');
Route::get('/registrusers/','UserController@registerUsers');
Route::get('/signusers/','UserController@signUsers');	