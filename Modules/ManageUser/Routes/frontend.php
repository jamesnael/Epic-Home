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

Route::post('register', 'RegisterController@register')->name('register.post');
Route::post('register/verifikasi', 'RegisterController@verifikasi')->name('register.verifikasi');
Route::post('register/resend', 'RegisterController@resend')->name('register.resend');

Route::post('login', 'LoginController@login')->name('login.post');
Route::post('login/verifikasi', 'LoginController@verifikasi')->name('login.verifikasi');
Route::post('login/resend', 'LoginController@resend')->name('login.resend');
