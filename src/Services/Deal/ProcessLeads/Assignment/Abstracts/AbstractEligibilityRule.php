<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Abstracts;

use Innoboxrr\Deals\Models\DealRouterExecution;
use Innoboxrr\Deals\Models\Deal;

abstract class AbstractEligibilityRule
{
    protected ?DealRouterExecution $execution = null;
    protected Deal $deal;

    public function setExecution(DealRouterExecution $execution): void
    {
        $this->execution = $execution;
        $this->deal = $execution->router->deal;
    }
}
