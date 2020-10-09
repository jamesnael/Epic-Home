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
	Route::get('berita-properti/table', 'BeritaPropertiController@table')->name('berita-properti.table');
	Route::get('berita-properti/{berita_properti}/data', 'BeritaPropertiController@data')->name('berita-properti.data');
	Route::apiResource('berita-properti', 'BeritaPropertiController')->only([
	    'store', 'update', 'destroy'
	]);
});