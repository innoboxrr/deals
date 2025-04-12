<?php

namespace Innoboxrr\Deals\Exports;

use Innoboxrr\Deals\Models\DealSession;
use Innoboxrr\SearchSurge\Search\Builder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DealSessionsExports implements FromView
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
            ) . 'deal_session', 
            [
                'deal_sessions' => $this->getQuery(),
                'exportCols' => DealSession::$export_cols
            ]
        );
    }

    public function getQuery()
    {   
        $builder = new Builder();
        return $builder->get(DealSession::class, $this->data, config('deals.search-options'));
    }

}