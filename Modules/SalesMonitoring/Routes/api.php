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

Route::namespace('Api')->group(function() {
	Route::get('sales-monitoring/table', 'SalesMonitoringController@table')->name('sales-monitoring.table');
	Route::get('sales-monitoring/{sales_monitoring}/data', 'SalesMonitoringController@data')->name('sales-monitoring.data');
	Route::apiResource('sales-monitoring', 'SalesMonitoringController')->only([
	    'store', 'update', 'destroy'
	]);
});