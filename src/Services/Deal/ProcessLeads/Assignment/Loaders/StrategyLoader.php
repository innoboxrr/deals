<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Loaders;

use Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Contracts\AssignmentStrategyInterface;
use Illuminate\Support\Facades\App;
use Innoboxrr\Deals\Models\DealRouterExecution;
use InvalidArgumentException;

class StrategyLoader
{
    protected const STRATEGY_NAMESPACE = 'Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Strategies';
    protected const DEFAULT_STRATEGY = 'WeightedRandomStrategy'; // Estrategia predeterminada

    public static function load(?string $strategy = null, DealRouterExecution $execution): AssignmentStrategyInterface 
    {
        $className = self::resolveClassName($strategy);
        if (!class_exists($className)) {
            throw new InvalidArgumentException("No se encontró la estrategia de asignación: {$strategy}");
        }

        $instance = App::make($className);
        if (!($instance instanceof AssignmentStrategyInterface)) {
            throw new InvalidArgumentException("La clase {$className} no implementa AssignmentStrategyInterface");
        }

        $dispersions = $execution->assignment_log['dispersions'];
        $leadIds = array_unique(array_column($dispersions, 'lead_id'));
        $agreementIds = array_unique(array_column($dispersions, 'agreement_id'));
        $instance->setContext($leadIds, $agreementIds, $dispersions, $execution);

        return $instance;
    }

    protected static function resolveClassName(?string $strategy = null): string
    {
        if (!$strategy) {
            return self::STRATEGY_NAMESPACE . '\\' . self::DEFAULT_STRATEGY;
        }
        return self::STRATEGY_NAMESPACE . '\\' . $strategy;
    }

}
