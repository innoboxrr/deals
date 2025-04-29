<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Contracts;

use Innoboxrr\Deals\Models\DealRouterExecution;

interface AgreementEligibilityRuleInterface
{
    public function setExecution(DealRouterExecution $execution): void;
    public function passes($agreement): bool;
    public function failReason(): string;
}
