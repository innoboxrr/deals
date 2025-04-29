<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads;

use Innoboxrr\Deals\Models\DealRouterExecution;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\AssignmentService;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\DeliveryService;

class ProcessLeadsService
{
    protected DealRouterExecution $execution;
    protected array $assignmentLog = [];

    public function __construct(DealRouterExecution $execution)
    {
        $this->execution = $execution;
    }

    public static function assignLeads(DealRouterExecution $execution): void
    {
        $instance = new self($execution);
        AssignmentService::run($instance->execution);
    }

    public static function deliverLeads(DealRouterExecution $execution): void
    {
        $instance = new self($execution);
        DeliveryService::run($instance->execution);
    }
}
