<?php

namespace Innoboxrr\Deals\Exports;

use Innoboxrr\Deals\Models\DealLead;
use Innoboxrr\SearchSurge\Search\Builder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DealLeadsExports implements FromView
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
            ) . 'deal_lead', 
            [
                'deal_leads' => $this->getQuery(),
                'exportCols' => DealLead::$export_cols
            ]
        );
    }

    public function getQuery()
    {   
        $builder = new Builder();
        return $builder->get(DealLead::class, $this->data, config('deals.search-options'));
    }

}