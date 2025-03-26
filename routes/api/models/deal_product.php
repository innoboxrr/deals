<?php

use Illuminate\Support\Facades\Route;

Route::get('policies', 'DealProductController@policies')
	->name('policies');

Route::get('policy', 'DealProductController@policy')
	->name('policy');

Route::get('index', 'DealProductController@index')
	->name('index');

Route::get('show', 'DealProductController@show')
	->name('show');

Route::post('create', 'DealProductController@create')
	->name('create');

Route::put('update', 'DealProductController@update')
	->name('update');

Route::delete('delete', 'DealProductController@delete')
	->name('delete');

Route::post('restore', 'DealProductController@restore')
	->name('restore');

Route::delete('force-delete', 'DealProductController@forceDelete')
	->name('force.delete');

Route::post('export', 'DealProductController@export')
	->name('export');