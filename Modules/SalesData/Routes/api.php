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

Route::prefix('sales-data')->namespace('Api')->group(function() {
	Route::get('sales/table', 'SalesController@table')->name('sales.table');
	Route::get('sales/table/approved', 'SalesController@tableApproved')->name('sales-approved.table');
	Route::get('sales/{sales}/data', 'SalesController@data')->name('sales.data');
	Route::apiResource('sales', 'SalesController')->parameters(['sales' => 'sales'])->only([
	    'store', 'update', 'destroy'
	]);

});
