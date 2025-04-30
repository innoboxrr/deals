<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Calls\Email;

use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Abstracts\AbstractCall;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Enums\CallType;

class EmailCall extends AbstractCall
{
    public function type(): string
    {
        return CallType::EMAIL->value;
    }
}
