<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Procedures;

use Innoboxrr\Deals\Models\DealRouterExecution;

use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Loggers\DeliveryLogger;
use Innoboxrr\Deals\Models\DealAssignment;
use Innoboxrr\Deals\Enums\DealAssignment\Status as DealAssignmentStatus;

class IntegrationDispatcher
{
    public static function run(DealRouterExecution $execution, DeliveryLogger $logger): void
    {
        DealAssignment::whereIn('status', DealAssignmentStatus::queueStates())
            ->update(['status' => DealAssignmentStatus::IN_PROGRESS->value]);

        DealAssignment::with('lead.lead', 'advertiserAgreement')
            ->where('status', DealAssignmentStatus::IN_PROGRESS->value)
            ->whereNull('delivery_deal_router_execution_id')
            ->chunkById(100, function ($assignments) use ($execution, $logger) {
                foreach ($assignments as $assignment) {
                    SendLead::run($assignment, $execution, $logger);
                }
            });
    }
}