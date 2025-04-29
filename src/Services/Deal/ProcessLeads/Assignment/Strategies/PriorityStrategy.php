<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Strategies;

use Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Abstracts\AbstractAssignmentStrategy;

class PriorityStrategy extends AbstractAssignmentStrategy
{
    public function assign(): array
    {
        $assignments = [];

        $grouped = $this->groupLeadsByAgreements();

        foreach ($this->leadIds as $leadId) {
            if (empty($grouped[$leadId])) {
                continue;
            }

            // Priorizar agreements por menor ID (puedes cambiar la prioridad real luego)
            $priorityAgreement = min($grouped[$leadId]);

            $assignments[] = [
                'lead_id' => $leadId,
                'assigned_agreement_id' => $priorityAgreement,
            ];
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
