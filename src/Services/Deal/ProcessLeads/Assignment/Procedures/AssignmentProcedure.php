<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Procedures;

use Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Loaders\StrategyLoader;
use Innoboxrr\Deals\Models\DealRouterExecution;
use Innoboxrr\Deals\Models\DealAssignment;
use Innoboxrr\Deals\Models\DealLead;
use Innoboxrr\Deals\Enums\DealLead\Status as DealLeadStatus;
use Innoboxrr\Deals\Enums\DealAssignment\Status as DealAssignmentStatus;

class AssignmentProcedure
{
    protected DealRouterExecution $execution;

    public function __construct(DealRouterExecution $execution)
    {
        $this->execution = $execution;
    }

    public static function run(DealRouterExecution $execution): array
    {
        $instance = new self($execution);
        $unassignedLeads = $instance->execution->unassigned_leads_from_log;
        $assignments = $instance->runAssignment();
        return $instance->make($unassignedLeads, $assignments);
    }

    protected function runAssignment(): array
    {
        $strategy = StrategyLoader::load(
            $this->execution->strategy->value, 
            $this->execution
        );
        return $strategy->assign();
    }

    protected function make($unassignedLeads, $assignments)
    {
        $this->unassignedLeads($unassignedLeads);
        return $this->assigLeads($assignments);
    }

    protected function unassignedLeads($unassignedLeads): void
    {
        $leadIds = collect($unassignedLeads)->pluck('lead_id')->toArray();
        DealLead::whereIn('id', $leadIds)->update([
            'status' => DealLeadStatus::UNASSIGNED->value,
        ]);
    }

    protected function assigLeads($assignments): array
    {
        return collect(value: $assignments)->map(function ($assignment) {
            
            $lead = DealLead::find($assignment['lead_id']);

            $assignmentModel = DealAssignment::create([
                'status' => DealAssignmentStatus::ASSIGNED->value,
                'deal_lead_id' => $assignment['lead_id'],
                'deal_advertiser_agreement_id' => $assignment['assigned_agreement_id'],
                'assigned_at' => now(),
                'assignment_deal_router_execution_id' => $this->execution->id,
            ]);

            $lead->update([
                'status' => DealLeadStatus::ASSIGNED->value,
                'deal_assignment_id' => $assignmentModel->id,
            ]);

            return $assignmentModel;
            
        })->map(function ($assignment) {
            return [
                'lead_id' => $assignment->deal_lead_id,
                'assigned_agreement_id' => $assignment->deal_advertiser_agreement_id,
                'assigned_at' => $assignment->assigned_at,
            ];
        })->toArray();
    }

}
