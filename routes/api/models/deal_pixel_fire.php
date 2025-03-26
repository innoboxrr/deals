<?php

use Illuminate\Support\Facades\Route;

Route::get('policies', 'DealPixelFireController@policies')
	->name('policies');

Route::get('policy', 'DealPixelFireController@policy')
	->name('policy');

Route::get('index', 'DealPixelFireController@index')
	->name('index');

Route::get('show', 'DealPixelFireController@show')
	->name('show');

Route::post('create', 'DealPixelFireController@create')
	->name('create');

Route::put('update', 'DealPixelFireController@update')
	->name('update');

Route::delete('delete', 'DealPixelFireController@delete')
	->name('delete');

Route::post('restore', 'DealPixelFireController@restore')
	->name('restore');

Route::delete('force-delete', 'DealPixelFireController@forceDelete')
	->name('force.delete');

Route::post('export', 'DealPixelFireController@export')
	->name('export');