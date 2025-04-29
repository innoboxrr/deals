<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Rules\AgreementEligibilityRules;

use Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Abstracts\AbstractEligibilityRule;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Contracts\AgreementEligibilityRuleInterface;

class CapLimitRule extends AbstractEligibilityRule implements AgreementEligibilityRuleInterface
{
    protected ?string $reason = null;

    public function passes($agreement): bool
    {
        if (is_null($agreement->payload['automation']['max_leads'] ?? null)) {
            return true; // No hay cap configurado
        }

        $assigned = (int) ($agreement->payload['distribution']['current_leads_assigned'] ?? 0);
        $cap = (int) ($agreement->payload['automation']['max_leads']);

        if ($assigned >= $cap) {
            $this->reason = "Cap limit reached for agreement ID: {$agreement->id}";
            return false;
        }

        return true;
    }

    public function failReason(): string
    {
        return $this->reason ?? 'Cap limit exceeded';
    }
}
