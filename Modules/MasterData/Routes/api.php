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

	Route::get('tipe-bangunan/table', 'TipeBangunanController@table')->name('tipe-bangunan.table');
	Route::get('tipe-bangunan/{tipe_bangunan}/data', 'TipeBangunanController@data')->name('tipe-bangunan.data');
	Route::apiResource('tipe-bangunan', 'TipeBangunanController')->only([
	    'store', 'update', 'destroy'
	]);

	Route::get('tipe-unit/table', 'TipeUnitController@table')->name('tipe-unit.table');
	Route::get('tipe-unit/{tipe_unit}/data', 'TipeUnitController@data')->name('tipe-unit.data');
	Route::apiResource('tipe-unit', 'TipeUnitController')->only([
	    'store', 'update', 'destroy'
	]);

	Route::get('agent-property/table', 'AgentPropertyController@table')->name('agent-property.table');
	Route::get('agent-property/{agent_property}/data', 'AgentPropertyController@data')->name('agent-property.data');
	Route::apiResource('agent-property', 'AgentPropertyController')->only([
	    'store', 'update', 'destroy'
	]);

	Route::get('faq/{faq}/data', 'FaqController@data')->name('faq.data');
	Route::apiResource('faq', 'FaqController')->only([
		'store', 'update', 'destroy'
	]);

	Route::get('developer/table', 'DeveloperController@table')->name('developer.table');
	Route::get('developer/{developer}/data', 'DeveloperController@data')->name('developer.data');
	Route::apiResource('developer', 'DeveloperController')->only([
	    'store', 'update', 'destroy'
	]);

	Route::get('bank/table', 'BankController@table')->name('bank.table');
	Route::get('bank/{bank}/data', 'BankController@data')->name('bank.data');
	Route::apiResource('bank', 'BankController')->only([
	    'store', 'update', 'destroy'
	]);

});
