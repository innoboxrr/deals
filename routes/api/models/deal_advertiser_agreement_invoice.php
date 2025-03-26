<?php

use Illuminate\Support\Facades\Route;

Route::get('policies', 'DealAdvertiserAgreementInvoiceController@policies')
	->name('policies');

Route::get('policy', 'DealAdvertiserAgreementInvoiceController@policy')
	->name('policy');

Route::get('index', 'DealAdvertiserAgreementInvoiceController@index')
	->name('index');

Route::get('show', 'DealAdvertiserAgreementInvoiceController@show')
	->name('show');

Route::post('create', 'DealAdvertiserAgreementInvoiceController@create')
	->name('create');

Route::put('update', 'DealAdvertiserAgreementInvoiceController@update')
	->name('update');

Route::delete('delete', 'DealAdvertiserAgreementInvoiceController@delete')
	->name('delete');

Route::post('restore', 'DealAdvertiserAgreementInvoiceController@restore')
	->name('restore');

Route::delete('force-delete', 'DealAdvertiserAgreementInvoiceController@forceDelete')
	->name('force.delete');

Route::post('export', 'DealAdvertiserAgreementInvoiceController@export')
	->name('export');