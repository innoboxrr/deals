<?php

use Illuminate\Support\Facades\Route;

Route::get('policies', 'DealLeadController@policies')
	->name('policies');

Route::get('policy', 'DealLeadController@policy')
	->name('policy');

Route::get('index', 'DealLeadController@index')
	->name('index');

Route::get('show', 'DealLeadController@show')
	->name('show');

Route::post('create', 'DealLeadController@create')
	->name('create');

Route::put('update', 'DealLeadController@update')
	->name('update');

Route::delete('delete', 'DealLeadController@delete')
	->name('delete');

Route::post('restore', 'DealLeadController@restore')
	->name('restore');

Route::delete('force-delete', 'DealLeadController@forceDelete')
	->name('force.delete');

Route::post('export', 'DealLeadController@export')
	->name('export');