<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Loaders;

use Illuminate\Support\Facades\App;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Contracts\LeadEligibilityRuleInterface;
use Innoboxrr\Deals\Models\DealRouterExecution;
use InvalidArgumentException;
use Illuminate\Support\Facades\Cache;

class LeadEligibilityLoader
{
    protected const RULES_NAMESPACE = 'Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Rules\LeadEligibilityRules';
    protected const CACHE_KEY = 'assignment_lead_rules_map';
    protected const CACHE_DURATION = 60 * 24 * 30; // 30 días

    public static function load(DealRouterExecution $execution): array
    {
        $rules = app()->environment('local', 'development')
            ? self::buildRules()
            : Cache::remember(self::CACHE_KEY, self::CACHE_DURATION, fn() => self::buildRules());

        foreach ($rules as $rule) {
            $rule->setExecution($execution);
        }

        return $rules;
    }

    protected static function buildRules(): array
    {
        $directory = __DIR__ . '/../Rules/LeadEligibilityRules'; // ← Aquí path RELATIVO
        $files = scandir($directory);

        $rules = [];

        foreach ($files as $file) {
            if (self::isValidRuleFile($file)) {
                $className = self::resolveClassName($file);

                if (!class_exists($className)) {
                    continue;
                }

                $instance = App::make($className);

                if (!($instance instanceof LeadEligibilityRuleInterface)) {
                    throw new InvalidArgumentException("La clase {$className} no implementa LeadEligibilityRuleInterface");
                }

                $rules[] = $instance;
            }
        }

        return $rules;
    }

    protected static function isValidRuleFile(string $file): bool
    {
        return str_ends_with($file, 'Rule.php') && !in_array($file, ['.', '..']);
    }

    protected static function resolveClassName(string $file): string
    {
        return self::RULES_NAMESPACE . '\\' . pathinfo($file, PATHINFO_FILENAME);
    }
}
