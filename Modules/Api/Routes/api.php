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

Route::namespace('Mobile')->group(function() {
	Route::get('klien/{sales_slug}', 'KlienController@index')->name('client.index');
	Route::post('klien/tambah', 'KlienController@store')->name('client.store');
	Route::post('klien/verifikasi', 'KlienController@verifikasi')->name('client.verifikasi');
	Route::post('klien/resend', 'KlienController@resend')->name('client.resend');

	Route::get('proyek_primary', 'ProyekPrimaryController@index')->name('proyek_primary.index');
	Route::get('proyek_primary/detail/{proyek_primary}', 'ProyekPrimaryController@detail')->name('proyek_primary.detail');
	Route::get('secondary_unit', 'SecondaryUnitController@index')->name('secondary_unit.index');
	Route::get('secondary_unit/detail/{secondary_unit}', 'SecondaryUnitController@detail')->name('secondary_unit.detail');

	Route::get('transaksi/{sales_slug}', 'TransaksiController@index')->name('transaksi.index');
	Route::get('transaksi/detail/{transaksi_slug}', 'TransaksiController@detail')->name('transaksi.detail');
	Route::post('transaksi/tambah', 'TransaksiController@store')->name('transaksi.store');
	
});