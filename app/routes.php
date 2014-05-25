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
Route::get('/','UserController@getIndex');
Route::get('users/login','UserController@getIndex');
Route::controller('users','UserController');
Route::put('checkupdate/{$id}','UserController@putCheckupdate');
Route::put('checkmyprofile/{$id}','UserController@putCheckmyprofile');
Route::controller('clientsuppliers', 'ClientSupplierController');
Route::post('checkupdate/{$id}','ClientSupplierController@postCheckupdate');
Route::controller('products', 'ProductController');
Route::controller('categories', 'ProductCategoryController');
Route::post('checkupdate/{$id}','ProductCategoryController@putCategoryupdate');
Route::post('checkupdate/{$id}','ProductController@putProductupdate');
Route::post('category', 'ProductController@getCategoryById');
Route::post('categoryDelete', 'ProductController@getDeleteCategoryById');
Route::post('categoryupdate', 'ProductController@categoryInlineUpdate');
Route::controller('offers', 'OfferController');
Route::post('checkupdate/{$id}','OfferController@putCheckUpdate');
Route::post('categoryinfo', 'OfferController@getCategoryId');
Route::post('offerProductDelete', 'OfferController@getDeleteOfferProductById');
