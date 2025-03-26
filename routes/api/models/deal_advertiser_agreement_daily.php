<?php

use Illuminate\Support\Facades\Route;

Route::get('policies', 'DealAdvertiserAgreementDailyController@policies')
	->name('policies');

Route::get('policy', 'DealAdvertiserAgreementDailyController@policy')
	->name('policy');

Route::get('index', 'DealAdvertiserAgreementDailyController@index')
	->name('index');

Route::get('show', 'DealAdvertiserAgreementDailyController@show')
	->name('show');

Route::post('create', 'DealAdvertiserAgreementDailyController@create')
	->name('create');

Route::put('update', 'DealAdvertiserAgreementDailyController@update')
	->name('update');

Route::delete('delete', 'DealAdvertiserAgreementDailyController@delete')
	->name('delete');

Route::post('restore', 'DealAdvertiserAgreementDailyController@restore')
	->name('restore');

Route::delete('force-delete', 'DealAdvertiserAgreementDailyController@forceDelete')
	->name('force.delete');

Route::post('export', 'DealAdvertiserAgreementDailyController@export')
	->name('export');