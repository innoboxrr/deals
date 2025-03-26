<?php

use Illuminate\Support\Facades\Route;

Route::get('policies', 'DealAdController@policies')
	->name('policies');

Route::get('policy', 'DealAdController@policy')
	->name('policy');

Route::get('index', 'DealAdController@index')
	->name('index');

Route::get('show', 'DealAdController@show')
	->name('show');

Route::post('create', 'DealAdController@create')
	->name('create');

Route::put('update', 'DealAdController@update')
	->name('update');

Route::delete('delete', 'DealAdController@delete')
	->name('delete');

Route::post('restore', 'DealAdController@restore')
	->name('restore');

Route::delete('force-delete', 'DealAdController@forceDelete')
	->name('force.delete');

Route::post('export', 'DealAdController@export')
	->name('export');