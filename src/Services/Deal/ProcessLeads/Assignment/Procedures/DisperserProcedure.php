<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Procedures;

use Illuminate\Contracts\Validation\Rule;
use Innoboxrr\Deals\Models\DealRouterExecution;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\DTOs\RuleResult;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Loaders\LeadEligibilityLoader;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Assignment\Loaders\AgreementEligibilityLoader;

class DisperserProcedure
{
    protected DealRouterExecution $execution;
    protected array $dispersions = [];
    protected array $unassignedLeads = [];

    public function __construct(DealRouterExecution $execution)
    {
        $this->execution = $execution;
    }

    public static function run(DealRouterExecution $execution): array
    {
        $instance = new self($execution);
        return $instance->handle();
    }

    protected function handle(): array
    {
        $leadRules = LeadEligibilityLoader::load($this->execution);
        $agreementRules = AgreementEligibilityLoader::load($this->execution);

        foreach ($this->execution->unprocessed_leads as $lead) {
            $result = $this->evaluateRules($lead, $leadRules);
            if (! $result->status) {
                $this->unassignedLeads[] = [
                    'lead_id' => $lead->id,
                    'reason' => $result->reason ?? 'Lead failed eligibility rules',
                ];
                continue;
            }

            $assigned = false;
            foreach ($this->execution->available_agreements as $agreement) {
                $result = $this->evaluateRules($agreement, $agreementRules);
                if ($result->status) {
                    $this->dispersions[] = [
                        'lead_id' => $lead->id,
                        'agreement_id' => $agreement->id,
                    ];
                    $assigned = true;
                }
            }
            if (! $assigned) {
                $this->unassignedLeads[] = [
                    'lead_id' => $lead->id,
                    'reason' => $result->reason ?? 'Lead did not match any agreement',
                ];
            }
        }

        return [$this->dispersions, $this->unassignedLeads];
    }

    protected function evaluateRules(mixed $target, array $rules): RuleResult
    {
        foreach ($rules as $rule) {
            if (! $rule->passes($target)) {
                return RuleResult::failure($rule->failReason());
            }
        }
        return RuleResult::success();
    }

}