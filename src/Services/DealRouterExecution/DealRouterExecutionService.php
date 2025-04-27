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
    protected ?array $assignmentLog = null;
    
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

    protected function createExecution(): void
    {
        $this->execution = DealRouterExecution::create([
            'start_execution' => now(),
            'assignment_log' => json_encode($this->assignmentLog ?? []),
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
        $this->execution->update([
            'end_execution' => now(),
            'assignment_log' => json_encode($this->assignmentLog ?? []),
        ]);
    }

    public function execute(): void
    {
        $this->startExecution();
        $this->assignmentLog = $this->deal->processLeads($this->execution);
        $this->endExecution();
    }

}