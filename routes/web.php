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

//vizualizar pdf
Route::get('/pdf/view/{bill_id}', 'PDFController@viewPDF');



Route::middleware(['auth'])->group(function () {

	Route::get('/home', 'HomeController@index')->name('home');


	//rutas modulo de usuarios
	Route::get('/users', 'UserController@index');
	Route::post('/users','UserController@store');
	Route::get('/users/{id}','UserController@show');
	Route::delete('/users/{id}', 'UserController@destroy');
	Route::put('/users/', 'UserController@update');
	Route::get('/users/detail/{email}','UserController@detail');
	Route::post('/users/tables', 'UserController@assignTable');

	//rutas platillos
	Route::get('/dishes', 'DishController@index');
	Route::post('/dishes','DishController@store');
	Route::get('/dishes/{id}','DishController@show');
	Route::get('/dishes/get/{id}', 'DishController@get');
	Route::put('/dishes', 'DishController@update');
	Route::delete('/dishes/{id}', 'DishController@destroy');

	//rutas mesas
	Route::get('/tables', 'TableController@index');
	Route::post('/tables','TableController@store');
	Route::get('/tables/{id}','TableController@show');
	Route::get('/tables/get/{id}','TableController@get');
	Route::put('/tables', 'TableController@update');
	Route::delete('/tables/{id}', 'TableController@destroy');

	//rutas modulo de ventas
	Route::get('/sales/{start_date?}/{end_date?}', 'BillController@index');
	Route::get('/bill_detail/{id}', 'BillController@detail');
	Route::get('/close_bill/{id}', 'BillController@close_bill');
	Route::get('/cancel_bill/{id}', 'BillController@cancel_bill');
	Route::put('/bill/update','BillController@update');

	//rutas del modulo caja
	Route::get('/box', 'BoxController@index');
	Route::get('/bill/amount/{id}', 'BoxController@totalAmount');

	//rutas del modulo mesero
	Route::get('/mesero', 'MeseroController@index');
	Route::get('/bill_table/{table_id}/{bill_id?}/', 'MeseroController@bill_table');
	Route::get('/addDsih/{dish_id}/{table_id}/{bill_id?}', 'BillController@add_dish');
	Route::get('removeDish/{bill_id}/{dish_id}', 'BillController@remove_quantity_dish');
	Route::get('add_people_number/{bill_id}/{table_id}' , 'BillController@add_people_number');
	Route::get('remove_people_number/{bill_id}' , 'BillController@remove_people_number');

	//rutas del modulo clientes
	Route::get('/clients/get/{rfc}', 'ClientController@get');
	//crear cliente y rlacionar con cueta
	Route::post('/clients/bill', 'ClientController@store');

	//generar pdf y descargar
	Route::get('/pdf/generate/{bill_id}', 'PDFController@generatePDF');
 

});