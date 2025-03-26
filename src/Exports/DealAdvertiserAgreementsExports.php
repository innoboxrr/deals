<?php

namespace Innoboxrr\Deals\Exports;

use Innoboxrr\Deals\Models\DealAdvertiserAgreement;
use Innoboxrr\SearchSurge\Search\Builder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DealAdvertiserAgreementsExports implements FromView
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
            ) . 'deal_advertiser_agreement', 
            [
                'deal_advertiser_agreements' => $this->getQuery(),
                'exportCols' => DealAdvertiserAgreement::$export_cols
            ]
        );
    }

    public function getQuery()
    {   
        $builder = new Builder();
        return $builder->get(DealAdvertiserAgreement::class, $this->data);
    }

}