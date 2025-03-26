<?php

use Illuminate\Support\Facades\Route;

Route::get('policies', 'DealRouterExecutionController@policies')
	->name('policies');

Route::get('policy', 'DealRouterExecutionController@policy')
	->name('policy');

Route::get('index', 'DealRouterExecutionController@index')
	->name('index');

Route::get('show', 'DealRouterExecutionController@show')
	->name('show');

Route::post('create', 'DealRouterExecutionController@create')
	->name('create');

Route::put('update', 'DealRouterExecutionController@update')
	->name('update');

Route::delete('delete', 'DealRouterExecutionController@delete')
	->name('delete');

Route::post('restore', 'DealRouterExecutionController@restore')
	->name('restore');

Route::delete('force-delete', 'DealRouterExecutionController@forceDelete')
	->name('force.delete');

Route::post('export', 'DealRouterExecutionController@export')
	->name('export');