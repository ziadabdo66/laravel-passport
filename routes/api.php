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
//admin
Route::post('registerAdmin','Api\AdminRegisterController@register');
Route::post('loginAdmin', 'Api\AdminRegisterController@login');
//user
Route::post('loginUser', 'Api\RegisterController@login');
Route::post('register','Api\RegisterController@register');
//user
Route::middleware('auth:api')->group(function () {
    Route::post('create','Api\BookController@create_book');
    Route::get('index','Api\BookController@index');


});
//admin
Route::middleware('auth:Admin-api')->group(function () {
    Route::post('createBook','Api\BookController@create_book');
    Route::get('indexBook','Api\BookController@index');


});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
