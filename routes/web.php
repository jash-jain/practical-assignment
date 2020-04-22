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
    return redirect()->route('login');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/service/{id}/counties', 'ServiceController@getCounties')->name('get.counties');
Route::get('/service/deleted', 'ServiceController@deleted')->name('service.deleted');
Route::get('/service/{id}/restore', 'ServiceController@restore')->name('service.restore');
Route::resource('/service', 'ServiceController');

Route::get('/county/deleted', 'CountyController@deleted')->name('county.deleted');
Route::get('/county/{id}/restore', 'CountyController@restore')->name('county.restore');
Route::get('/county/{county}/services', 'CountyController@getServices')->name('county.services');

Route::resource('/county', 'CountyController');


Route::get('/states', 'StatesController@index')->name('states.index');
Route::get('/states/{state}/counties', 'StatesController@getCounties')->name('state.counties');
