<?php

use Illuminate\Support\Facades\Route;

Route::get('policies', 'DealSessionController@policies')
	->name('policies');

Route::get('policy', 'DealSessionController@policy')
	->name('policy');

Route::get('index', 'DealSessionController@index')
	->name('index');

Route::get('show', 'DealSessionController@show')
	->name('show');

Route::post('create', 'DealSessionController@create')
	->name('create');

Route::put('update', 'DealSessionController@update')
	->name('update');

Route::delete('delete', 'DealSessionController@delete')
	->name('delete');

Route::post('restore', 'DealSessionController@restore')
	->name('restore');

Route::delete('force-delete', 'DealSessionController@forceDelete')
	->name('force.delete');

Route::post('export', 'DealSessionController@export')
	->name('export');