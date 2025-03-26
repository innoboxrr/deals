<?php

use Illuminate\Support\Facades\Route;

Route::get('policies', 'DealLeadTrackingEventController@policies')
	->name('policies');

Route::get('policy', 'DealLeadTrackingEventController@policy')
	->name('policy');

Route::get('index', 'DealLeadTrackingEventController@index')
	->name('index');

Route::get('show', 'DealLeadTrackingEventController@show')
	->name('show');

Route::post('create', 'DealLeadTrackingEventController@create')
	->name('create');

Route::put('update', 'DealLeadTrackingEventController@update')
	->name('update');

Route::delete('delete', 'DealLeadTrackingEventController@delete')
	->name('delete');

Route::post('restore', 'DealLeadTrackingEventController@restore')
	->name('restore');

Route::delete('force-delete', 'DealLeadTrackingEventController@forceDelete')
	->name('force.delete');

Route::post('export', 'DealLeadTrackingEventController@export')
	->name('export');