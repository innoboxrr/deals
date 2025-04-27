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
        $this->assignmentLog = [];
    }

    public static function run(DealRouterExecution $execution): array
    {
        $instance = new self($execution);
        $instance->handle();
        return $instance->getAssignmentLog();
    }

    protected function handle(): void
    {
        $dealLeads = $this->getPendingDealLeads();

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

    protected function getPendingDealLeads()
    {
        return $this->execution->router->deal->dealLeads()
            ->whereDoesntHave('dealAssignments') // No asignado todavía
            ->where('status', 'pending')
            ->get();
    }

    protected function getAvailableAgreements()
    {
        return $this->execution->router->deal->dealAdvertiserAgreements()
            ->where('status', 'active')
            ->get();
    }

    protected function logAssignment($dealLead, $agreement, $dealAssignment): void
    {
        $this->assignmentLog[] = [
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
