<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Calls\Api;

use Innoboxrr\Deals\Models\DealRouterExecution;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Contracts\DeliveryStrategyInterface;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Contracts\CallTypeInterface;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\DTOs\DeliveryResult;

class ApiStrategy implements DeliveryStrategyInterface
{
    public function dispatch(DealRouterExecution $execution, int $leadId, int $agreementId, CallTypeInterface $call): DeliveryResult
    {
        return DeliveryResult::pending([]);
    }
}
