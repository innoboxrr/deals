<?php

namespace Innoboxrr\Deals\Exports;

use Innoboxrr\Deals\Models\DealGateway;
use Innoboxrr\SearchSurge\Search\Builder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DealGatewaysExports implements FromView
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
            ) . 'deal_gateway', 
            [
                'deal_gateways' => $this->getQuery(),
                'exportCols' => DealGateway::$export_cols
            ]
        );
    }

    public function getQuery()
    {   
        $builder = new Builder();
        return $builder->get(DealGateway::class, $this->data);
    }

}