<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Rules\LeadEligibilityRules;

use Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Abstracts\AbstractEligibilityRule;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Contracts\LeadEligibilityRuleInterface;
use Innoboxrr\Deals\Enums\DealLead\Status;

class StatusRule extends AbstractEligibilityRule implements LeadEligibilityRuleInterface
{
    protected ?string $reason = null;

    public function passes($lead): bool
    {
        if ($lead->status->value !== Status::UNPROCESSED->value) {
            $this->reason = "Lead ID {$lead->id} is not pending (status: {$lead->status->value})";
            return false;
        }

        return true;
    }

    public function failReason(): string
    {
        return $this->reason ?? 'Lead status is not unprocessed';
    }
}
