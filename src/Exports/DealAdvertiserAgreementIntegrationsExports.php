<?php

namespace Innoboxrr\Deals\Exports;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementIntegration;
use Innoboxrr\SearchSurge\Search\Builder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DealAdvertiserAgreementIntegrationsExports implements FromView
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
            ) . 'deal_advertiser_agreement_integration', 
            [
                'deal_advertiser_agreement_integrations' => $this->getQuery(),
                'exportCols' => DealAdvertiserAgreementIntegration::$export_cols
            ]
        );
    }

    public function getQuery()
    {   
        $builder = new Builder();
        return $builder->get(DealAdvertiserAgreementIntegration::class, $this->data);
    }

}