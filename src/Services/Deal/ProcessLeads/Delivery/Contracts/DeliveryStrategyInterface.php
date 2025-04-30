<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Contracts;

use Innoboxrr\Deals\Models\DealRouterExecution;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\DTOs\DeliveryResult;

interface DeliveryStrategyInterface
{
    public function dispatch(DealRouterExecution $execution, int $leadId, int $agreementId, CallTypeInterface $call): DeliveryResult;
}
