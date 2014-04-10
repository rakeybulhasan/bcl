<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*Route::get('/', function()
{
	return View::make('hello');
});*/
Route::get('/','UserController@getIndex');
Route::controller('users','UserController');
Route::put('checkupdate/{$id}','UserController@putCheckupdate');
Route::controller('clientsuppliers', 'ClientSupplierController');
Route::post('checkupdate/{$id}','ClientSupplierController@postCheckupdate');
Route::controller('products', 'ProductController');
