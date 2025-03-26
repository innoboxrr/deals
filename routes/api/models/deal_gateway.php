<?php

use Illuminate\Support\Facades\Route;

Route::get('policies', 'DealGatewayController@policies')
	->name('policies');

Route::get('policy', 'DealGatewayController@policy')
	->name('policy');

Route::get('index', 'DealGatewayController@index')
	->name('index');

Route::get('show', 'DealGatewayController@show')
	->name('show');

Route::post('create', 'DealGatewayController@create')
	->name('create');

Route::put('update', 'DealGatewayController@update')
	->name('update');

Route::delete('delete', 'DealGatewayController@delete')
	->name('delete');

Route::post('restore', 'DealGatewayController@restore')
	->name('restore');

Route::delete('force-delete', 'DealGatewayController@forceDelete')
	->name('force.delete');

Route::post('export', 'DealGatewayController@export')
	->name('export');