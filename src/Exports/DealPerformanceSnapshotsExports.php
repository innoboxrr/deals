<?php

namespace Innoboxrr\Deals\Exports;

use Innoboxrr\Deals\Models\DealPerformanceSnapshot;
use Innoboxrr\SearchSurge\Search\Builder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DealPerformanceSnapshotsExports implements FromView
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
            ) . 'deal_performance_snapshot', 
            [
                'deal_performance_snapshots' => $this->getQuery(),
                'exportCols' => DealPerformanceSnapshot::$export_cols
            ]
        );
    }

    public function getQuery()
    {   
        $builder = new Builder();
        return $builder->get(DealPerformanceSnapshot::class, $this->data);
    }

}