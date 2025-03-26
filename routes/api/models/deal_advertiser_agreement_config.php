<?php

use Illuminate\Support\Facades\Route;

Route::get('policies', 'DealAdvertiserAgreementConfigController@policies')
	->name('policies');

Route::get('policy', 'DealAdvertiserAgreementConfigController@policy')
	->name('policy');

Route::get('index', 'DealAdvertiserAgreementConfigController@index')
	->name('index');

Route::get('show', 'DealAdvertiserAgreementConfigController@show')
	->name('show');

Route::post('create', 'DealAdvertiserAgreementConfigController@create')
	->name('create');

Route::put('update', 'DealAdvertiserAgreementConfigController@update')
	->name('update');

Route::delete('delete', 'DealAdvertiserAgreementConfigController@delete')
	->name('delete');

Route::post('restore', 'DealAdvertiserAgreementConfigController@restore')
	->name('restore');

Route::delete('force-delete', 'DealAdvertiserAgreementConfigController@forceDelete')
	->name('force.delete');

Route::post('export', 'DealAdvertiserAgreementConfigController@export')
	->name('export');