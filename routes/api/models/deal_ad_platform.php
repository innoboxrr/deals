<?php

use Illuminate\Support\Facades\Route;

Route::get('policies', 'DealAdPlatformController@policies')
	->name('policies');

Route::get('policy', 'DealAdPlatformController@policy')
	->name('policy');

Route::get('index', 'DealAdPlatformController@index')
	->name('index');

Route::get('show', 'DealAdPlatformController@show')
	->name('show');

Route::post('create', 'DealAdPlatformController@create')
	->name('create');

Route::put('update', 'DealAdPlatformController@update')
	->name('update');

Route::delete('delete', 'DealAdPlatformController@delete')
	->name('delete');

Route::post('restore', 'DealAdPlatformController@restore')
	->name('restore');

Route::delete('force-delete', 'DealAdPlatformController@forceDelete')
	->name('force.delete');

Route::post('export', 'DealAdPlatformController@export')
	->name('export');