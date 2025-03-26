<?php

use Illuminate\Support\Facades\Route;

Route::get('policies', 'DealAdCampaignRuleController@policies')
	->name('policies');

Route::get('policy', 'DealAdCampaignRuleController@policy')
	->name('policy');

Route::get('index', 'DealAdCampaignRuleController@index')
	->name('index');

Route::get('show', 'DealAdCampaignRuleController@show')
	->name('show');

Route::post('create', 'DealAdCampaignRuleController@create')
	->name('create');

Route::put('update', 'DealAdCampaignRuleController@update')
	->name('update');

Route::delete('delete', 'DealAdCampaignRuleController@delete')
	->name('delete');

Route::post('restore', 'DealAdCampaignRuleController@restore')
	->name('restore');

Route::delete('force-delete', 'DealAdCampaignRuleController@forceDelete')
	->name('force.delete');

Route::post('export', 'DealAdCampaignRuleController@export')
	->name('export');