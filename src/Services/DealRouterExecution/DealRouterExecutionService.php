<?php

namespace Innoboxrr\Deals\Services\DealRouterExecution;

use Innoboxrr\Deals\Models\Deal;
use Innoboxrr\Deals\Models\DealRouter;

class DealRouterExecutionService
{
    protected DealRouter $router;
    protected Deal $deal;
    
    public function __construct(DealRouter $router, Deal $deal) 
    {
        $this->router = $router;
        $this->deal = $deal;
    }

    public static function run(DealRouter $router, Deal $deal): void
    {
        $instance = new self($router, $deal);
        $instance->execute();
    }

    public function execute(): void
    {
        $this->router->update(['last_run' => now()]);
        $this->deal->update(['queue' => $this->router->queue]);

        //  Enviar el lead al agreement 
    }

}