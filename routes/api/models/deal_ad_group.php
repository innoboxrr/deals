<?php

use Illuminate\Support\Facades\Route;

Route::get('policies', 'DealAdGroupController@policies')
	->name('policies');

Route::get('policy', 'DealAdGroupController@policy')
	->name('policy');

Route::get('index', 'DealAdGroupController@index')
	->name('index');

Route::get('show', 'DealAdGroupController@show')
	->name('show');

Route::post('create', 'DealAdGroupController@create')
	->name('create');

Route::put('update', 'DealAdGroupController@update')
	->name('update');

Route::delete('delete', 'DealAdGroupController@delete')
	->name('delete');

Route::post('restore', 'DealAdGroupController@restore')
	->name('restore');

Route::delete('force-delete', 'DealAdGroupController@forceDelete')
	->name('force.delete');

Route::post('export', 'DealAdGroupController@export')
	->name('export');