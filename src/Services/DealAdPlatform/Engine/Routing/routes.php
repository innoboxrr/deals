<?php

use Illuminate\Support\Facades\Route;
use Innoboxrr\Deals\Services\DealAdPlatform\Engine\Http\Controllers\OAuthController;
use Innoboxrr\Deals\Services\DealAdPlatform\Engine\Http\Controllers\WebhookController;
use Innoboxrr\Deals\Services\DealAdPlatform\Engine\Http\Controllers\PlatformActionController;

Route::prefix('deals/ad-platform/engine')->name('deals.ad.platform.engine.')->group(function () {

    // ------ OAuth genérico (dinámico por plataforma) ------
    Route::get('platforms/{platform}/oauth/authorization', [OAuthController::class, 'authorization'])
        ->name('oauth.authorization');
    Route::match(['get', 'post'], 'platforms/{platform}/oauth/callback', [OAuthController::class, 'callback'])
        ->name('oauth.callback');
    Route::post('platforms/{platform}/oauth/refresh', [OAuthController::class, 'refresh'])
        ->name('oauth.refresh');
    Route::post('platforms/{platform}/oauth/disconnect', [OAuthController::class, 'disconnect'])
        ->name('oauth.disconnect');

    // ------ Webhooks (tema dinámico: leads|conversions|...) ------
    Route::post('webhooks/{platform}/{topic}', [WebhookController::class, 'receive'])
        ->name('webhooks.receive');

    // ------ Dispatcher de acciones genéricas ------
    // action: list|get|create|update|pause|resume|stats|assets.list|assets.upload|audiences.addUsers...
    Route::match(['get', 'post'], 'platforms/{platform}/act/{action}', PlatformActionController::class)
        ->name('platforms.act');
});
