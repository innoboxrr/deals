<?php

namespace Innoboxrr\Deals\Exports;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementCplAdjustment;
use Innoboxrr\SearchSurge\Search\Builder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DealAdvertiserAgreementCplAdjustmentsExports implements FromView
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
            ) . 'deal_advertiser_agreement_cpl_adjustment', 
            [
                'deal_advertiser_agreement_cpl_adjustments' => $this->getQuery(),
                'exportCols' => DealAdvertiserAgreementCplAdjustment::$export_cols
            ]
        );
    }

    public function getQuery()
    {   
        $builder = new Builder();
        return $builder->get(DealAdvertiserAgreementCplAdjustment::class, $this->data, config('deals.search-options'));
    }

}