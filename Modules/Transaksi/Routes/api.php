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
Route::prefix('transaksi')->namespace('Api')->group(function() {
	Route::get('titip-jual-sewa/table', 'TitipJualSewaController@table')->name('titip-jual-sewa.table');
	Route::get('titip-jual-sewa/table-sukses', 'TitipJualSewaController@tableSucess')->name('titip-jual-sewa-sukses.table');

	Route::get('titip-jual-sewa/{titip_jual_sewa}/data', 'TitipJualSewaController@data')->name('titip-jual-sewa.data');
	Route::apiResource('titip-jual-sewa', 'TitipJualSewaController')->only([
	    'store', 'update', 'destroy'
	]);

	Route::get('transaksi-proyek-primary/table', 'TransaksiProyekPrimaryController@table')->name('transaksi-proyek-primary.table');
	Route::get('transaksi-proyek-primary/table-bayar', 'TransaksiProyekPrimaryController@tableBayar')->name('transaksi-proyek-primary-bayar.table');

	Route::get('transaksi-secondary-unit/table', 'TransaksiSecondaryUnitController@table')->name('transaksi-secondary-unit.table');
	Route::get('transaksi-secondary-unit/table-bayar', 'TransaksiSecondaryUnitController@tableBayar')->name('transaksi-secondary-unit-bayar.table');

	Route::get('transaksi-pemesanan/{transaksi_pemesanan}/data', 'TransaksiPemesananController@data')->name('transaksi-pemesanan.data');	
	Route::apiResource('transaksi-pemesanan', 'TransaksiPemesananController')->only([
	    'store','update'
	]);

	Route::apiResource('klien', 'KlienController')->only([
	    'store'
	]);


});