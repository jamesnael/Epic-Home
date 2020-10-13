<?php

use Illuminate\Http\Request;

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

Route::prefix('kelola-user')->namespace('Api')->group(function() {
	Route::get('grup-user/table', 'GrupUserController@table')->name('grup-user.table');
	Route::get('grup-user/{grup_user}/data', 'GrupUserController@data')->name('grup-user.data');
	Route::apiResource('grup-user', 'GrupUserController')->only([
	    'store', 'update', 'destroy'
	]);

	Route::get('user/table', 'UserController@table')->name('user.table');
	Route::get('user/{user}/data', 'UserController@data')->name('user.data');
	Route::apiResource('user', 'UserController')->only([
	    'store', 'update', 'destroy'
	]);

	Route::get('customer/table', 'CustomerController@table')->name('customer.table');
	Route::get('customer/table/verified', 'CustomerController@tableApproved')->name('customer.table-verified');
	Route::get('customer/{customer}/data', 'CustomerController@data')->name('customer.data');
	Route::apiResource('customer', 'CustomerController')->only([
	    'update', 'destroy'
	]);

	Route::get('sales/table', 'SalesController@table')->name('sales.table');
	Route::get('sales/table/approved', 'SalesController@tableApproved')->name('sales-approved.table');
	Route::get('sales/{sales}/data', 'SalesController@data')->name('sales.data');
	Route::apiResource('sales', 'SalesController')->parameters(['sales' => 'sales'])->only([
	    'store', 'update', 'destroy'
	]);

});
