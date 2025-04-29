<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Abstracts;

use Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Contracts\AssignmentStrategyInterface;
use Innoboxrr\Deals\Models\DealRouterExecution;

abstract class AbstractAssignmentStrategy implements AssignmentStrategyInterface
{
    protected ?DealRouterExecution $execution = null;
    protected array $dispersions = [];
    protected array $leadIds = [];
    protected array $agreementIds = [];

    public function setContext(
        array $leadIds,
        array $agreementIds,
        array $dispersions,
        DealRouterExecution $execution
    ): void {
        $this->leadIds = $leadIds;
        $this->agreementIds = $agreementIds;
        $this->dispersions = $dispersions;
        $this->execution = $execution;
    }

    abstract public function assign(): array;
}