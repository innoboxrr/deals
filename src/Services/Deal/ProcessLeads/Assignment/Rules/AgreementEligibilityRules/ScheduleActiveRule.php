<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Rules\AgreementEligibilityRules;

use Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Abstracts\AbstractEligibilityRule;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Contracts\AgreementEligibilityRuleInterface;
use Carbon\Carbon;

class ScheduleActiveRule extends AbstractEligibilityRule implements AgreementEligibilityRuleInterface
{
    protected ?string $reason = null;

    public function passes($agreement): bool
    {
        $now = Carbon::now($this->execution->timezone ?? config('app.timezone', 'UTC'));
        $start = isset($agreement->payload['general']['start_date']) ? Carbon::parse($agreement->payload['general']['start_date']) : null;
        $end = isset($agreement->payload['general']['end_date']) ? Carbon::parse($agreement->payload['general']['end_date']) : null;

        if ($start && $now->lessThan($start)) {
            $this->reason = "Agreement not started yet (starts at {$start->toDateTimeString()})";
            return false;
        }

        if ($end && $now->greaterThan($end)) {
            $this->reason = "Agreement already ended (ended at {$end->toDateTimeString()})";
            return false;
        }

        return true;
    }

    public function failReason(): string
    {
        return $this->reason ?? 'Agreement schedule invalid';
    }
}
