<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Strategies;

use Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Abstracts\AbstractAssignmentStrategy;

class RoundRobinStrategy extends AbstractAssignmentStrategy
{
    protected int $currentIndex = 0;

    public function assign(): array
    {
        $assignments = [];

        $grouped = $this->groupLeadsByAgreements();

        foreach ($this->leadIds as $leadId) {
            if (empty($grouped[$leadId])) {
                continue;
            }

            $agreementId = $grouped[$leadId][$this->currentIndex % count($grouped[$leadId])];
            $assignments[] = [
                'lead_id' => $leadId,
                'assigned_agreement_id' => $agreementId,
            ];

            $this->currentIndex++;
        }

        return $assignments;
    }

    protected function groupLeadsByAgreements(): array
    {
        $grouped = [];

        foreach ($this->dispersions as $dispersion) {
            $grouped[$dispersion['lead_id']][] = $dispersion['agreement_id'];
        }

        return $grouped;
    }
}
