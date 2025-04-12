<?php

namespace Innoboxrr\Deals\Exports;

use Innoboxrr\Deals\Models\DealSessionEvent;
use Innoboxrr\SearchSurge\Search\Builder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DealSessionEventsExports implements FromView
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
            ) . 'deal_session_event', 
            [
                'deal_session_events' => $this->getQuery(),
                'exportCols' => DealSessionEvent::$export_cols
            ]
        );
    }

    public function getQuery()
    {   
        $builder = new Builder();
        return $builder->get(DealSessionEvent::class, $this->data, config('deals.search-options'));
    }

}