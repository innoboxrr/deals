<?php

namespace Innoboxrr\Deals\Exports;

use Innoboxrr\Deals\Models\DealRouter;
use Innoboxrr\SearchSurge\Search\Builder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DealRoutersExports implements FromView
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
            ) . 'deal_router', 
            [
                'deal_routers' => $this->getQuery(),
                'exportCols' => DealRouter::$export_cols
            ]
        );
    }

    public function getQuery()
    {   
        $builder = new Builder();
        return $builder->get(DealRouter::class, $this->data);
    }

}