<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Contracts;

use Innoboxrr\Deals\Models\DealRouterExecution;

interface AssignmentStrategyInterface
{
    public function assign(): array;

    public function setContext(
        array $leadIds,
        array $agreementIds,
        array $dispersions,
        DealRouterExecution $execution
    ): void;
}
