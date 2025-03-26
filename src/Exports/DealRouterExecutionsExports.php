<?php

namespace Innoboxrr\Deals\Exports;

use Innoboxrr\Deals\Models\DealRouterExecution;
use Innoboxrr\SearchSurge\Search\Builder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DealRouterExecutionsExports implements FromView
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
            ) . 'deal_router_execution', 
            [
                'deal_router_executions' => $this->getQuery(),
                'exportCols' => DealRouterExecution::$export_cols
            ]
        );
    }

    public function getQuery()
    {   
        $builder = new Builder();
        return $builder->get(DealRouterExecution::class, $this->data);
    }

}