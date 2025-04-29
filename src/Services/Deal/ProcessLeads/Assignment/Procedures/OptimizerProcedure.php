<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Procedures;

use Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Loaders\StrategyLoader;
use Innoboxrr\Deals\Models\DealRouterExecution;

class OptimizerProcedure
{
    protected DealRouterExecution $execution;

    public function __construct(DealRouterExecution $execution)
    {
        $this->execution = $execution;
    }

    public static function run(DealRouterExecution $execution): array
    {
        $instance = new self($execution);
        return $instance->handle();
    }

    protected function handle(): array
    {
        $strategy = StrategyLoader::load(
            $this->execution->strategy->value, 
            $this->execution
        );

        return $strategy->assign();
    }
}
