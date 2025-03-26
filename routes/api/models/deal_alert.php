<?php

use Illuminate\Support\Facades\Route;

Route::get('policies', 'DealAlertController@policies')
	->name('policies');

Route::get('policy', 'DealAlertController@policy')
	->name('policy');

Route::get('index', 'DealAlertController@index')
	->name('index');

Route::get('show', 'DealAlertController@show')
	->name('show');

Route::post('create', 'DealAlertController@create')
	->name('create');

Route::put('update', 'DealAlertController@update')
	->name('update');

Route::delete('delete', 'DealAlertController@delete')
	->name('delete');

Route::post('restore', 'DealAlertController@restore')
	->name('restore');

Route::delete('force-delete', 'DealAlertController@forceDelete')
	->name('force.delete');

Route::post('export', 'DealAlertController@export')
	->name('export');