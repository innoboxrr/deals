<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Rules\LeadEligibilityRules;

use Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Abstracts\AbstractEligibilityRule;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Contracts\LeadEligibilityRuleInterface;
use Innoboxrr\Deals\Enums\DealLead\Status;

class AgeRule extends AbstractEligibilityRule implements LeadEligibilityRuleInterface
{
    protected ?string $reason = null;

    public function passes($lead): bool
    {
        if($this->deal->min_age && $lead->age < $this->deal->min_age) {
            $this->reason = "Lead ID {$lead->id} is under minimum age requirement (age: {$lead->age}, min: {$this->deal->min_age})";
            return false;
        }

        if($this->deal->max_age && $lead->age > $this->deal->max_age) {
            $this->reason = "Lead ID {$lead->id} exceeds maximum age requirement (age: {$lead->age}, max: {$this->deal->max_age})";
            return false;
        }

        return true;
    }

    public function failReason(): string
    {
        return $this->reason ?? 'Lead does not meet the minimum age requirement';
    }
}
