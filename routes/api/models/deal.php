<?php

use Illuminate\Support\Facades\Route;

Route::get('policies', 'DealController@policies')
	->name('policies');

Route::get('policy', 'DealController@policy')
	->name('policy');

Route::get('index', 'DealController@index')
	->name('index');

Route::get('show', 'DealController@show')
	->name('show');

Route::post('create', 'DealController@create')
	->name('create');

Route::put('update', 'DealController@update')
	->name('update');

Route::delete('delete', 'DealController@delete')
	->name('delete');

Route::post('restore', 'DealController@restore')
	->name('restore');

Route::delete('force-delete', 'DealController@forceDelete')
	->name('force.delete');

Route::post('export', 'DealController@export')
	->name('export');