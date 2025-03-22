<?php

namespace Innoboxrr\Deals\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        
        // $this->mergeConfigFrom(__DIR__ . '/../../config/innoboxrrdeals.php', 'innoboxrrdeals');

    }

    public function boot()
    {
        
        // $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        // $this->loadViewsFrom(__DIR__.'/../../resources/views', 'innoboxrrdeals');

        if ($this->app->runningInConsole()) {
            
            // $this->publishes([__DIR__.'/../../resources/views' => resource_path('views/vendor/innoboxrrdeals'),], 'views');

            // $this->publishes([__DIR__.'/../../config/innoboxrrdeals.php' => config_path('innoboxrrdeals.php')], 'config');

        }

    }
    
}