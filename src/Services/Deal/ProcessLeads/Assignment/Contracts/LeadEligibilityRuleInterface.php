<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Contracts;

use Innoboxrr\Deals\Models\DealRouterExecution;

interface LeadEligibilityRuleInterface
{
    public function setExecution(DealRouterExecution $execution): void;
    public function passes($lead): bool;
    public function failReason(): string;
}
