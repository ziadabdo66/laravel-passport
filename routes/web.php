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

Route::get('/', function () {
    return view('welcome');
});
Route::group(['namespace'=>'ajax'],function (){
    Route::get('index','AjaxController@index');
   Route::get('create','AjaxController@create');
   Route::post('store','AjaxController@store')->name('ajaxStore');
   Route::post('delete','AjaxController@delete')->name('ajaxDelete');
    Route::get('update/{id}','AjaxController@updates')->name('ajaxUpdate');
    Route::post('edit','AjaxController@edit')->name('ajaxEdit');
    Route::get('duplicate/{id}','AjaxController@duplicate')->name('ajaxDuplicate');
    Route::post('copy','AjaxController@Copy')->name('ajaxCopy');
});
