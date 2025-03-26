<?php

use Illuminate\Support\Facades\Route;

Route::get('policies', 'DealAdvertiserPaymentMethodController@policies')
	->name('policies');

Route::get('policy', 'DealAdvertiserPaymentMethodController@policy')
	->name('policy');

Route::get('index', 'DealAdvertiserPaymentMethodController@index')
	->name('index');

Route::get('show', 'DealAdvertiserPaymentMethodController@show')
	->name('show');

Route::post('create', 'DealAdvertiserPaymentMethodController@create')
	->name('create');

Route::put('update', 'DealAdvertiserPaymentMethodController@update')
	->name('update');

Route::delete('delete', 'DealAdvertiserPaymentMethodController@delete')
	->name('delete');

Route::post('restore', 'DealAdvertiserPaymentMethodController@restore')
	->name('restore');

Route::delete('force-delete', 'DealAdvertiserPaymentMethodController@forceDelete')
	->name('force.delete');

Route::post('export', 'DealAdvertiserPaymentMethodController@export')
	->name('export');