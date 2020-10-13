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

Route::middleware('auth')->group(function() {
	require __DIR__.'/api.php';
});

Route::prefix('transaksi')->namespace('View')->group(function() {
	Route::resource('titip-jual-sewa', 'TitipJualSewaController')->only([
	    'index', 'create', 'edit'
	]);

	Route::resource('transaksi-proyek-primary', 'TransaksiProyekPrimaryController')->only([
	    'index', 'create', 'edit'
	]);

	Route::resource('transaksi-secondary-unit', 'TransaksiSecondaryUnitController')->only([
	    'index', 'create', 'edit'
	]);
});
