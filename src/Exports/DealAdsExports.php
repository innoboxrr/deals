<?php

namespace Innoboxrr\Deals\Exports;

use Innoboxrr\Deals\Models\DealAd;
use Innoboxrr\SearchSurge\Search\Builder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DealAdsExports implements FromView
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
            ) . 'deal_ad', 
            [
                'deal_ads' => $this->getQuery(),
                'exportCols' => DealAd::$export_cols
            ]
        );
    }

    public function getQuery()
    {   
        $builder = new Builder();
        return $builder->get(DealAd::class, $this->data, config('deals.search-options'));
    }

}