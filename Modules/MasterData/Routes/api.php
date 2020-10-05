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
});
