<?php

namespace Innoboxrr\Deals\Exports;

use Innoboxrr\Deals\Models\DealAdCampaignRule;
use Innoboxrr\SearchSurge\Search\Builder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DealAdCampaignRulesExports implements FromView
{

    protected $data;

    public function __construct( array $data) 
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view(
            config(
                'innoboxrrdeals.excel_view', 
                'innoboxrrdeals::excel.'
            ) . 'deal_ad_campaign_rule', 
            [
                'deal_ad_campaign_rules' => $this->getQuery(),
                'exportCols' => DealAdCampaignRule::$export_cols
            ]
        );
    }

    public function getQuery()
    {   
        $builder = new Builder();
        return $builder->get(DealAdCampaignRule::class, $this->data);
    }

}