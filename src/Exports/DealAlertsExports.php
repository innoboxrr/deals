<?php

namespace Innoboxrr\Deals\Exports;

use Innoboxrr\Deals\Models\DealAlert;
use Innoboxrr\SearchSurge\Search\Builder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DealAlertsExports implements FromView
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
            ) . 'deal_alert', 
            [
                'deal_alerts' => $this->getQuery(),
                'exportCols' => DealAlert::$export_cols
            ]
        );
    }

    public function getQuery()
    {   
        $builder = new Builder();
        return $builder->get(DealAlert::class, $this->data);
    }

}