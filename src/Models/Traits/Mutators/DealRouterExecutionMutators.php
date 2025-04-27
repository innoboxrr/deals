<?php

namespace Innoboxrr\Deals\Models\Traits\Mutators;

trait DealRouterExecutionMutators
{

    public function getUnprocessedLeadsAttribute()
    {
        $deal = $this->router->deal;
    
        $deal->load([
            'gateways.dealLeads' => function ($query) {
                $query->light();
            }
        ]);
    
        $dealLeads = $deal->gateways->pluck('dealLeads')->flatten();

        return $dealLeads;
    }
    

}