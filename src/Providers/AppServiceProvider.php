<?php

namespace Innoboxrr\Deals\Providers;

use Illuminate\Support\ServiceProvider;
use Innoboxrr\Deals\Console\Commands\Deal\TakeDealPerformanceSnapshotCommand;
use Innoboxrr\Deals\Console\Commands\DealRouterExecution\DealRouterExecutionCommand;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/deals.php', 'deals');

        $this->commands([
            TakeDealPerformanceSnapshotCommand::class,
            DealRouterExecutionCommand::class,
        ]);
    }

    public function boot()
    {
        
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        // $this->loadViewsFrom(__DIR__.'/../../resources/views', 'deals');

        if ($this->app->runningInConsole()) {
            
            // $this->publishes([__DIR__.'/../../resources/views' => resource_path('views/vendor/deals'),], 'views');

            $this->publishes([__DIR__.'/../../config/deals.php' => config_path('deals.php')], 'config');

        }

    }
    
}