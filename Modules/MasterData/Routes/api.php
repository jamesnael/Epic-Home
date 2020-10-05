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

Route::prefix('master-data')->namespace('Api')->group(function() {
	Route::get('tipe-proyek/table', 'TipeProyekController@table')->name('tipe-proyek.table');
	Route::get('tipe-proyek/{tipe_proyek}/data', 'TipeProyekController@data')->name('tipe-proyek.data');
	Route::apiResource('tipe-proyek', 'TipeProyekController')->only([
	    'store', 'update', 'destroy'
	]);

	Route::get('tipe-bangunan/{tipe_bangunan}/data', 'TipeBangunanController@data')->name('tipe-bangunan.data');
	Route::apiResource('tipe-bangunan', 'TipeBangunanController')->only([
	    'store', 'update', 'destroy'
	]);

	Route::get('tipe-unit/{tipe_unit}/data', 'TipeUnitController@data')->name('tipe-unit.data');
	Route::apiResource('tipe-unit', 'TipeUnitController')->only([
	    'store', 'update', 'destroy'
	]);
});
