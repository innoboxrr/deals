<?php

namespace Innoboxrr\Deals\Jobs\DealRouterExecution;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Innoboxrr\Deals\Services\DealRouterExecution\DealRouterExecutionService;
use Innoboxrr\Deals\Models\Deal;
use Innoboxrr\Deals\Models\DealRouter;

class DealRouterExecutionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected DealRouter $router;
    protected Deal $deal;
    protected bool $sync = false;
    protected string $strategy;

    /**
     * Create a new job instance.
     */
    public function __construct(DealRouter $router, Deal $deal, ?string $strategy = null)
    {
        $this->router = $router;
        $this->deal = $deal;
        $this->strategy = $strategy;
    }

    public function handle(): void
    {
        try {
            DealRouterExecutionService::run($this->router, $this->deal, $this->strategy);   
            return; 
        } catch (\Exception $e) {
            report($e);
        }
    }
}
