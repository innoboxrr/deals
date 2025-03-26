<?php

use Illuminate\Support\Facades\Route;

Route::get('policies', 'DealAdvertiserController@policies')
	->name('policies');

Route::get('policy', 'DealAdvertiserController@policy')
	->name('policy');

Route::get('index', 'DealAdvertiserController@index')
	->name('index');

Route::get('show', 'DealAdvertiserController@show')
	->name('show');

Route::post('create', 'DealAdvertiserController@create')
	->name('create');

Route::put('update', 'DealAdvertiserController@update')
	->name('update');

Route::delete('delete', 'DealAdvertiserController@delete')
	->name('delete');

Route::post('restore', 'DealAdvertiserController@restore')
	->name('restore');

Route::delete('force-delete', 'DealAdvertiserController@forceDelete')
	->name('force.delete');

Route::post('export', 'DealAdvertiserController@export')
	->name('export');