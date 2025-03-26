<?php

namespace Innoboxrr\Deals\Exports;

use Innoboxrr\Deals\Models\DealAdvertiser;
use Innoboxrr\SearchSurge\Search\Builder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DealAdvertisersExports implements FromView
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
            ) . 'deal_advertiser', 
            [
                'deal_advertisers' => $this->getQuery(),
                'exportCols' => DealAdvertiser::$export_cols
            ]
        );
    }

    public function getQuery()
    {   
        $builder = new Builder();
        return $builder->get(DealAdvertiser::class, $this->data);
    }

}