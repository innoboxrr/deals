<?php

use Illuminate\Support\Facades\Route;

Route::get('policies', 'DealAdCampaignController@policies')
	->name('policies');

Route::get('policy', 'DealAdCampaignController@policy')
	->name('policy');

Route::get('index', 'DealAdCampaignController@index')
	->name('index');

Route::get('show', 'DealAdCampaignController@show')
	->name('show');

Route::post('create', 'DealAdCampaignController@create')
	->name('create');

Route::put('update', 'DealAdCampaignController@update')
	->name('update');

Route::delete('delete', 'DealAdCampaignController@delete')
	->name('delete');

Route::post('restore', 'DealAdCampaignController@restore')
	->name('restore');

Route::delete('force-delete', 'DealAdCampaignController@forceDelete')
	->name('force.delete');

Route::post('export', 'DealAdCampaignController@export')
	->name('export');