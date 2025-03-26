<?php

namespace Innoboxrr\Deals\Exports;

use Innoboxrr\Deals\Models\DealAdvertiserPaymentMethod;
use Innoboxrr\SearchSurge\Search\Builder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DealAdvertiserPaymentMethodsExports implements FromView
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
            ) . 'deal_advertiser_payment_method', 
            [
                'deal_advertiser_payment_methods' => $this->getQuery(),
                'exportCols' => DealAdvertiserPaymentMethod::$export_cols
            ]
        );
    }

    public function getQuery()
    {   
        $builder = new Builder();
        return $builder->get(DealAdvertiserPaymentMethod::class, $this->data);
    }

}