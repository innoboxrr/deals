<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Loggers;

use Innoboxrr\Deals\Models\DealRouterExecution;

class AssignmentResultLogger
{
    protected DealRouterExecution $execution;

    public function __construct(DealRouterExecution $execution)
    {
        $this->execution = $execution;
    }

    public function logDispersions(array $dispersions): void
    {
        $log = $this->getOrInitializeLog();

        foreach ($dispersions as $dispersion) {
            $log['dispersions'][] = [
                'lead_id' => $dispersion['lead_id'],
                'agreement_id' => $dispersion['agreement_id'],
                'dispersed_at' => now()->toDateTimeString(),
            ];
        }

        $this->execution->assignment_log = $log;
        $this->execution->save();
    }

    public function logAssignments(array $assignments): void
    {
        $log = $this->getOrInitializeLog();

        foreach ($assignments as $assignment) {
            $log['assignments'][] = [
                'lead_id' => $assignment['lead_id'],
                'assigned_agreement_id' => $assignment['assigned_agreement_id'],
                'assigned_at' => now()->toDateTimeString(),
            ];
        }

        $this->execution->assignment_log = $log;
        $this->execution->save();
    }

    public function logUnassignedLeads(array $unassignedLeads): void
    {
        $log = $this->getOrInitializeLog();

        foreach ($unassignedLeads as $lead) {
            $log['unassigned_leads'][] = [
                'lead_id' => $lead['lead_id'],
                'reason' => $lead['reason'] ?? null,
                'unassigned_at' => now()->toDateTimeString(),
            ];
        }

        $this->execution->assignment_log = $log;
        $this->execution->save();
    }

    public function logError(string $errorMessage): void
    {
        $log = $this->getOrInitializeLog();

        $log['errors'][] = [
            'message' => $errorMessage,
            'occurred_at' => now()->toDateTimeString(),
        ];

        $this->execution->assignment_log = $log;
        $this->execution->save();
    }

    protected function getOrInitializeLog(): array
    {
        $currentLog = $this->execution->assignment_log ?? [];
    
        if (is_string($currentLog)) {
            $currentLog = json_decode($currentLog, true) ?? [];
        }
    
        return array_merge([
            'dispersions' => $currentLog['dispersions'] ?? [],
            'unassigned_leads' => $currentLog['unassigned_leads'] ?? [],
            'assignments' => $currentLog['assignments'] ?? [],
            'errors' => $currentLog['errors'] ?? [],
        ], $currentLog);
    }
    
}
