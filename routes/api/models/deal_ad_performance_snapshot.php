<?php

use Illuminate\Support\Facades\Route;

Route::get('policies', 'DealAdPerformanceSnapshotController@policies')
	->name('policies');

Route::get('policy', 'DealAdPerformanceSnapshotController@policy')
	->name('policy');

Route::get('index', 'DealAdPerformanceSnapshotController@index')
	->name('index');

Route::get('show', 'DealAdPerformanceSnapshotController@show')
	->name('show');

Route::post('create', 'DealAdPerformanceSnapshotController@create')
	->name('create');

Route::put('update', 'DealAdPerformanceSnapshotController@update')
	->name('update');

Route::delete('delete', 'DealAdPerformanceSnapshotController@delete')
	->name('delete');

Route::post('restore', 'DealAdPerformanceSnapshotController@restore')
	->name('restore');

Route::delete('force-delete', 'DealAdPerformanceSnapshotController@forceDelete')
	->name('force.delete');

Route::post('export', 'DealAdPerformanceSnapshotController@export')
	->name('export');