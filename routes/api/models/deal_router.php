<?php

use Illuminate\Support\Facades\Route;

Route::get('policies', 'DealRouterController@policies')
	->name('policies');

Route::get('policy', 'DealRouterController@policy')
	->name('policy');

Route::get('index', 'DealRouterController@index')
	->name('index');

Route::get('show', 'DealRouterController@show')
	->name('show');

Route::post('create', 'DealRouterController@create')
	->name('create');

Route::put('update', 'DealRouterController@update')
	->name('update');

Route::delete('delete', 'DealRouterController@delete')
	->name('delete');

Route::post('restore', 'DealRouterController@restore')
	->name('restore');

Route::delete('force-delete', 'DealRouterController@forceDelete')
	->name('force.delete');

Route::post('export', 'DealRouterController@export')
	->name('export');