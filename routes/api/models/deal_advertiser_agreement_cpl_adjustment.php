<?php

use Illuminate\Support\Facades\Route;

Route::get('policies', 'DealAdvertiserAgreementCplAdjustmentController@policies')
	->name('policies');

Route::get('policy', 'DealAdvertiserAgreementCplAdjustmentController@policy')
	->name('policy');

Route::get('index', 'DealAdvertiserAgreementCplAdjustmentController@index')
	->name('index');

Route::get('show', 'DealAdvertiserAgreementCplAdjustmentController@show')
	->name('show');

Route::post('create', 'DealAdvertiserAgreementCplAdjustmentController@create')
	->name('create');

Route::put('update', 'DealAdvertiserAgreementCplAdjustmentController@update')
	->name('update');

Route::delete('delete', 'DealAdvertiserAgreementCplAdjustmentController@delete')
	->name('delete');

Route::post('restore', 'DealAdvertiserAgreementCplAdjustmentController@restore')
	->name('restore');

Route::delete('force-delete', 'DealAdvertiserAgreementCplAdjustmentController@forceDelete')
	->name('force.delete');

Route::post('export', 'DealAdvertiserAgreementCplAdjustmentController@export')
	->name('export');