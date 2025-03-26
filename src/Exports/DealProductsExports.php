<?php

namespace Innoboxrr\Deals\Exports;

use Innoboxrr\Deals\Models\DealProduct;
use Innoboxrr\SearchSurge\Search\Builder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DealProductsExports implements FromView
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
            ) . 'deal_product', 
            [
                'deal_products' => $this->getQuery(),
                'exportCols' => DealProduct::$export_cols
            ]
        );
    }

    public function getQuery()
    {   
        $builder = new Builder();
        return $builder->get(DealProduct::class, $this->data);
    }

}