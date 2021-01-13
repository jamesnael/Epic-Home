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

Route::namespace('Mobile')->middleware('auth:api')->group(function() {
	Route::get('klien/{sales_slug}', 'KlienController@index')->name('client.index');
	Route::post('klien/tambah', 'KlienController@store')->name('client.store');
	Route::post('klien/verifikasi', 'KlienController@verifikasi')->name('client.verifikasi');
	Route::post('klien/resend', 'KlienController@resend')->name('client.resend');

	Route::get('proyek_primary', 'ProyekPrimaryController@index')->name('proyek_primary.index');
	Route::get('proyek_primary/detail/{id}', 'ProyekPrimaryController@detail')->name('proyek_primary.detail');

	Route::get('secondary_unit', 'SecondaryUnitController@index')->name('secondary_unit.index');
	Route::get('secondary_unit/detail/{id}', 'SecondaryUnitController@detail')->name('secondary_unit.detail');
	
	Route::post('listing/tambah', 'ListingController@store')->name('listing.store');
	Route::get('listing/proyek_primary/{sales_slug}', 'ListingController@indexPrimary')->name('listing.proyek_primary_index');
	Route::get('listing/secondary_unit/{sales_slug}', 'ListingController@indexSecondary')->name('listing.secondary_unit_index');

	Route::get('transaksi/{sales_slug}', 'TransaksiController@index')->name('transaksi.index');
	Route::get('transaksi/detail/{transaksi_slug}', 'TransaksiController@detail')->name('transaksi.detail');
	Route::post('transaksi/tambah', 'TransaksiController@store')->name('transaksi.store');

	Route::get('sales_monitoring', 'SalesMonitoringController@index')->name('sales_monitoring.index');
	Route::get('sales_monitoring/edit/{slug}', 'SalesMonitoringController@edit')->name('sales_monitoring.edit');
	Route::post('sales_monitoring/tambah', 'SalesMonitoringController@store')->name('sales_monitoring.store');
	Route::post('sales_monitoring/update/{slug}', 'SalesMonitoringController@update')->name('sales_monitoring.update');
});