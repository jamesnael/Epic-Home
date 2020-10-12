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

Route::prefix('kelola-user')->namespace('View')->group(function() {
	Route::resource('grup-user', 'GrupUserController')->only([
	    'index', 'create', 'edit'
	]);

	Route::resource('user', 'UserController')->only([
	    'index', 'create', 'edit'
	]);

	Route::resource('sales', 'SalesController')->parameters(['sales' => 'sales'])->only([
	    'index', 'create', 'edit'
	]);

	Route::resource('customer', 'CustomerController')->only([
	    'index', 'edit'
	]);
});

Route::prefix('security')->namespace('Auth')->group(function() {
	Route::get('/email/verify', 'VerifyController@notice')->name('verification.notice');
	Route::get('/email/verify/{id}/{hash}', 'VerifyController@verify')->middleware(['signed'])->name('verification.verify');
	Route::post('/email/verify/resend', 'VerifyController@resend')->middleware(['throttle:6,1'])->name('verification.send');
});
