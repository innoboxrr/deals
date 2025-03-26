<?php

use Illuminate\Support\Facades\Route;

Route::get('policies', 'DealAdvertiserAgreementPostbackController@policies')
	->name('policies');

Route::get('policy', 'DealAdvertiserAgreementPostbackController@policy')
	->name('policy');

Route::get('index', 'DealAdvertiserAgreementPostbackController@index')
	->name('index');

Route::get('show', 'DealAdvertiserAgreementPostbackController@show')
	->name('show');

Route::post('create', 'DealAdvertiserAgreementPostbackController@create')
	->name('create');

Route::put('update', 'DealAdvertiserAgreementPostbackController@update')
	->name('update');

Route::delete('delete', 'DealAdvertiserAgreementPostbackController@delete')
	->name('delete');

Route::post('restore', 'DealAdvertiserAgreementPostbackController@restore')
	->name('restore');

Route::delete('force-delete', 'DealAdvertiserAgreementPostbackController@forceDelete')
	->name('force.delete');

Route::post('export', 'DealAdvertiserAgreementPostbackController@export')
	->name('export');