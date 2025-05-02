<?php

namespace Innoboxrr\Deals\Services\DealRouterExecution;

use Innoboxrr\Deals\Models\Deal;
use Innoboxrr\Deals\Models\DealRouter;
use Innoboxrr\Deals\Models\DealRouterExecution;

class DealRouterExecutionService
{
    protected DealRouter $router;
    protected Deal $deal;
    protected DealRouterExecution $execution;
    protected ?string $strategy = null;
    
    public function __construct(DealRouter $router, ?string $strategy = null) 
    {
        $this->router = $router;
        $this->deal = $router->deal;
        $this->strategy = $strategy;
    }

    public static function run(DealRouter $router, ?string $strategy = null): void
    {
        $instance = new self($router, $strategy);
        $instance->execute();
    }

    protected function createExecution(): void
    {
        $this->execution = DealRouterExecution::create([
            'start_execution' => now(),
            'strategy' => $this->strategy,
            'assignment_log' => json_encode([]),
            'deal_router_id' => $this->router->id,
        ]);
    }

    protected function startExecution(): void
    {
        $this->createExecution();
        $this->router->update(['last_run' => now()]);
        $this->deal->update(['queue' => $this->router->queue]);
    }

    protected function endExecution(): void
    {
        $this->execution->update(['end_execution' => now()]);
    }

    public function execute(): void
    {
        $this->startExecution();
        $this->deal->assignLeads($this->execution);
        $this->deal->deliverLeads($this->execution);
        $this->endExecution();
    }
}