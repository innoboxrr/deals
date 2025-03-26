<?php

use Illuminate\Support\Facades\Route;

Route::get('policies', 'DealSessionEventController@policies')
	->name('policies');

Route::get('policy', 'DealSessionEventController@policy')
	->name('policy');

Route::get('index', 'DealSessionEventController@index')
	->name('index');

Route::get('show', 'DealSessionEventController@show')
	->name('show');

Route::post('create', 'DealSessionEventController@create')
	->name('create');

Route::put('update', 'DealSessionEventController@update')
	->name('update');

Route::delete('delete', 'DealSessionEventController@delete')
	->name('delete');

Route::post('restore', 'DealSessionEventController@restore')
	->name('restore');

Route::delete('force-delete', 'DealSessionEventController@forceDelete')
	->name('force.delete');

Route::post('export', 'DealSessionEventController@export')
	->name('export');