<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment;

use Innoboxrr\Deals\Models\DealRouterExecution;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Procedures\DisperserProcedure;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Procedures\AssignmentProcedure;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Loggers\AssignmentResultLogger;

class AssignmentService
{
    protected DealRouterExecution $execution;
    protected AssignmentResultLogger $logger;

    public function __construct(DealRouterExecution $execution)
    {
        $this->execution = $execution;
        $this->logger = new AssignmentResultLogger($this->execution);
    }

    public static function run(DealRouterExecution $execution): void
    {
        $instance = new self($execution);
        $instance->handle();
    }

    protected function handle(): void
    {
        try {
            $this->runDispersion();
            $this->runAssignment();
        } catch (\Exception $e) {
            $this->handleException($e);
        }
    }
    
    protected function runDispersion(): void
    {
        [$dispersions, $unassignedLeads] = DisperserProcedure::run($this->execution);
    
        if (empty($dispersions) && empty($unassignedLeads)) {
            return;
        }
    
        $this->logger->logDispersions($dispersions);
    
        if (!empty($unassignedLeads)) {
            $this->logger->logUnassignedLeads($unassignedLeads);
        }
    }
    
    protected function runAssignment(): void
    {
        $assignments = AssignmentProcedure::run($this->execution);
        
        if (empty($assignments)) {
            return;
        }

        $this->logger->logAssignments($assignments);
    }
    
    protected function handleException(\Exception $e): void
    {
        $this->logger->logError($e->getMessage());
        report($e);
    }
}