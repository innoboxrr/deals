<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads;

use Innoboxrr\Deals\Models\DealRouterExecution;

class ProcessLeadsService
{
    protected DealRouterExecution $execution;
    protected array $assignmentLog = [];

    public function __construct(DealRouterExecution $execution)
    {
        $this->execution = $execution;
        $this->assignmentLog = [
            'assignments' => [],
            'unprocessed_leads' => 0,
            'start_execution' => now()->toDateTimeString(),
            'end_execution' => null,
            'errors' => [],
        ];
    }

    public static function run(DealRouterExecution $execution): array
    {
        $instance = new self($execution);
        $instance->handle();
        return $instance->getAssignmentLog();
    }

    protected function handle(): void
    {
        $dealLeads = $this->execution->unprocessed_leads;

        // Ya estoy acá

        if ($dealLeads->isEmpty()) {
            return;
        }

        $agreements = $this->getAvailableAgreements();

        if ($agreements->isEmpty()) {
            return;
        }

        foreach ($dealLeads as $dealLead) {
            $agreement = AgreementSelectorService::select($agreements, $dealLead);

            if ($agreement) {
                $dealAssignment = IntegrationService::create($dealLead, $agreement, $this->execution);
                $this->logAssignment($dealLead, $agreement, $dealAssignment);
            }
        }
    }

    protected function getAvailableAgreements()
    {
        return $this->execution->router->deal->dealAdvertiserAgreements()
            ->where('status', 'active')
            ->get();
    }

    protected function logAssignment($dealLead, $agreement, $dealAssignment): void
    {
        $this->assignmentLog['assignments'][] = [
            'deal_lead_id' => $dealLead->id,
            'deal_assignment_id' => $dealAssignment->id,
            'assigned_to' => $agreement->id,
            'assigned_at' => now()->toDateTimeString(),
        ];
    }

    public function getAssignmentLog(): array
    {
        return $this->assignmentLog;
    }
}
