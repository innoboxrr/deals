<?php

use Illuminate\Support\Facades\Route;

Route::get('policies', 'DealAdvertiserAgreementIntegrationController@policies')
	->name('policies');

Route::get('policy', 'DealAdvertiserAgreementIntegrationController@policy')
	->name('policy');

Route::get('index', 'DealAdvertiserAgreementIntegrationController@index')
	->name('index');

Route::get('show', 'DealAdvertiserAgreementIntegrationController@show')
	->name('show');

Route::post('create', 'DealAdvertiserAgreementIntegrationController@create')
	->name('create');

Route::put('update', 'DealAdvertiserAgreementIntegrationController@update')
	->name('update');

Route::delete('delete', 'DealAdvertiserAgreementIntegrationController@delete')
	->name('delete');

Route::post('restore', 'DealAdvertiserAgreementIntegrationController@restore')
	->name('restore');

Route::delete('force-delete', 'DealAdvertiserAgreementIntegrationController@forceDelete')
	->name('force.delete');

Route::post('export', 'DealAdvertiserAgreementIntegrationController@export')
	->name('export');