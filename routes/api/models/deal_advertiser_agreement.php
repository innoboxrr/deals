<?php

use Illuminate\Support\Facades\Route;

Route::get('policies', 'DealAdvertiserAgreementController@policies')
	->name('policies');

Route::get('policy', 'DealAdvertiserAgreementController@policy')
	->name('policy');

Route::get('index', 'DealAdvertiserAgreementController@index')
	->name('index');

Route::get('show', 'DealAdvertiserAgreementController@show')
	->name('show');

Route::post('create', 'DealAdvertiserAgreementController@create')
	->name('create');

Route::put('update', 'DealAdvertiserAgreementController@update')
	->name('update');

Route::delete('delete', 'DealAdvertiserAgreementController@delete')
	->name('delete');

Route::post('restore', 'DealAdvertiserAgreementController@restore')
	->name('restore');

Route::delete('force-delete', 'DealAdvertiserAgreementController@forceDelete')
	->name('force.delete');

Route::post('export', 'DealAdvertiserAgreementController@export')
	->name('export');