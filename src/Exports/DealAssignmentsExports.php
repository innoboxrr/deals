<?php

namespace Innoboxrr\Deals\Exports;

use Innoboxrr\Deals\Models\DealAssignment;
use Innoboxrr\SearchSurge\Search\Builder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DealAssignmentsExports implements FromView
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
            ) . 'deal_assignment', 
            [
                'deal_assignments' => $this->getQuery(),
                'exportCols' => DealAssignment::$export_cols
            ]
        );
    }

    public function getQuery()
    {   
        $builder = new Builder();
        return $builder->get(DealAssignment::class, $this->data);
    }

}