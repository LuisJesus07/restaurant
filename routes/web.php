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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::middleware(['auth'])->group(function () {

	Route::get('/home', 'HomeController@index')->name('home');


	//rutas platillos
	Route::get('/dishes', 'DishController@index');
	Route::post('/dishes','DishController@store');
	Route::get('/dishes/{id}','DishController@show');
	Route::put('/dishes', 'DishController@update');
	Route::delete('/dishes/{id}', 'DishController@destroy');

	//rutas mesas
	Route::get('/tables', 'TableController@index');
	Route::post('/tables','TableController@store');
	Route::get('/tables/{id}','TableController@show');
	Route::get('/tables/get/{id}','TableController@get');
	Route::put('/tables', 'TableController@update');
	Route::delete('/tables/{id}', 'TableController@destroy');
 

});