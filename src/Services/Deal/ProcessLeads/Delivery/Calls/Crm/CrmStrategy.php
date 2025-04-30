<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Calls\Crm;

use Innoboxrr\Deals\Models\DealRouterExecution;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Contracts\DeliveryStrategyInterface;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Contracts\CallTypeInterface;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\DTOs\DeliveryResult;

class CrmStrategy implements DeliveryStrategyInterface
{
    public function dispatch(DealRouterExecution $execution, int $leadId, int $agreementId, CallTypeInterface $call): DeliveryResult
    {
        return DeliveryResult::pending([]);
    }
}
