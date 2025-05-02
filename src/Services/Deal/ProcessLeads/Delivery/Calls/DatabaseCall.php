<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Calls;

use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Abstracts\AbstractCall;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Enums\CallType;

class DatabaseCall extends AbstractCall
{
    public function type(): string
    {
        return CallType::DATABASE->value;
    }
}
