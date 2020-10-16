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

Route::get('klien', 'KlienController@getClientList')->name('klien.get');
Route::post('klien', 'KlienController@storeClient')->name('klien.post');
Route::post('klien/verifikasi', 'KlienController@verifikasi')->name('klien.verifikasi');
Route::post('klien/resend', 'KlienController@resend')->name('klien.resend');
