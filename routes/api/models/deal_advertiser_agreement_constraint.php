<?php

use Illuminate\Support\Facades\Route;

Route::get('policies', 'DealAdvertiserAgreementConstraintController@policies')
	->name('policies');

Route::get('policy', 'DealAdvertiserAgreementConstraintController@policy')
	->name('policy');

Route::get('index', 'DealAdvertiserAgreementConstraintController@index')
	->name('index');

Route::get('show', 'DealAdvertiserAgreementConstraintController@show')
	->name('show');

Route::post('create', 'DealAdvertiserAgreementConstraintController@create')
	->name('create');

Route::put('update', 'DealAdvertiserAgreementConstraintController@update')
	->name('update');

Route::delete('delete', 'DealAdvertiserAgreementConstraintController@delete')
	->name('delete');

Route::post('restore', 'DealAdvertiserAgreementConstraintController@restore')
	->name('restore');

Route::delete('force-delete', 'DealAdvertiserAgreementConstraintController@forceDelete')
	->name('force.delete');

Route::post('export', 'DealAdvertiserAgreementConstraintController@export')
	->name('export');