<?php

namespace Innoboxrr\Deals\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{

    public function map()
    {

        $this->mapApiRoutes();      

    }

    protected function mapApiRoutes()
    {

        foreach (glob(__DIR__ . '/../../routes/api/models/*.php') as $file) {

            $name = basename($file, '.php');

            Route::middleware('api')
                ->prefix('api/innoboxrr/deals/' . $name)
                ->as('api.innoboxrr.deals.' . $name . '.')
                ->namespace('Innoboxrr\Deals\Http\Controllers')
                ->group($file);

        }

    }

}
