<?php

namespace Innoboxrr\Deals\Enums\DealRouterExecution;

use Innoboxrr\Deals\Support\Traits\EnumTrait;

enum Strategy: string
{
    use EnumTrait;

    case PriorityStrategy = 'PriorityStrategy';
    case RoundRobinStrategy = 'RoundRobinStrategy';
    case WeightedRandomStrategy = 'WeightedRandomStrategy';
    case RandomStrategy = 'RandomStrategy';
}