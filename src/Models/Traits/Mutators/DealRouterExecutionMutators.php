<?php

namespace Innoboxrr\Deals\Models\Traits\Mutators;

use Innoboxrr\Deals\Enums\DealLead\Status as DealLeadStatus;

trait DealRouterExecutionMutators
{

    public function getUnprocessedLeadsAttribute()
    {
        $deal = $this->router->deal;
        $deal->load([
            'gateways.dealLeads' => function ($query) {
                $query->where('status', DealLeadStatus::UNPROCESSED->value);
                $query->light();
            }
        ]);
        $dealLeads = $deal->gateways->pluck('dealLeads')->flatten();
        return $dealLeads;
    }
    
    public function getAvailableAgreementsAttribute()
    {
        return $this->router->deal->activeDealAdvertiserAgreements;
    }

    public function getUnassignedLeadsFromLogAttribute()
    {
        return $this->assignment_log['unassigned_leads'] ?? [];
    }
}