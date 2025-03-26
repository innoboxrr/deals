<?php

use Illuminate\Support\Facades\Route;

Route::get('policies', 'DealPerformanceSnapshotController@policies')
	->name('policies');

Route::get('policy', 'DealPerformanceSnapshotController@policy')
	->name('policy');

Route::get('index', 'DealPerformanceSnapshotController@index')
	->name('index');

Route::get('show', 'DealPerformanceSnapshotController@show')
	->name('show');

Route::post('create', 'DealPerformanceSnapshotController@create')
	->name('create');

Route::put('update', 'DealPerformanceSnapshotController@update')
	->name('update');

Route::delete('delete', 'DealPerformanceSnapshotController@delete')
	->name('delete');

Route::post('restore', 'DealPerformanceSnapshotController@restore')
	->name('restore');

Route::delete('force-delete', 'DealPerformanceSnapshotController@forceDelete')
	->name('force.delete');

Route::post('export', 'DealPerformanceSnapshotController@export')
	->name('export');