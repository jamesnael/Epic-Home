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

Route::prefix('master-data')->namespace('View')->group(function() {
	Route::resource('tipe-proyek', 'TipeProyekController')->only([
	    'index', 'create', 'edit'
	]);
	
	Route::resource('tipe-bangunan', 'TipeBangunanController')->only([
	    'index', 'create', 'edit'
	]);

	Route::resource('tipe-unit', 'TipeUnitController')->only([
	    'index', 'create', 'edit'
	]);

	Route::resource('agent-property', 'AgentPropertyController')->only([
	    'index', 'create', 'edit'
	]);

	Route::get('proyek-primary/{proyek_primary}/unit', 'UnitController@index')->name('unit.index');
	Route::resource('unit', 'UnitController')->only([
	    'create', 'edit'
	]);

	Route::resource('faq', 'FaqController')->only([
		'index', 'create', 'edit'
	]);

	Route::resource('proyek-primary', 'ProyekPrimaryController')->only([
		'index', 'create', 'edit', 'show'
	]);

	Route::resource('cluster', 'ClusterController')->only([
		'index', 'create', 'edit'
	]);
		
	Route::resource('developer', 'DeveloperController')->only([
	    'index', 'create', 'edit'
	]);

	Route::resource('bank', 'BankController')->only([
	    'index', 'create', 'edit'
	]);

	Route::resource('secondary-unit', 'SecondaryUnitController')->only([
	    'index', 'create', 'edit'
	]);
});
