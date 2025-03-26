<?php

use Illuminate\Support\Facades\Route;

Route::get('policies', 'DealAssignmentController@policies')
	->name('policies');

Route::get('policy', 'DealAssignmentController@policy')
	->name('policy');

Route::get('index', 'DealAssignmentController@index')
	->name('index');

Route::get('show', 'DealAssignmentController@show')
	->name('show');

Route::post('create', 'DealAssignmentController@create')
	->name('create');

Route::put('update', 'DealAssignmentController@update')
	->name('update');

Route::delete('delete', 'DealAssignmentController@delete')
	->name('delete');

Route::post('restore', 'DealAssignmentController@restore')
	->name('restore');

Route::delete('force-delete', 'DealAssignmentController@forceDelete')
	->name('force.delete');

Route::post('export', 'DealAssignmentController@export')
	->name('export');