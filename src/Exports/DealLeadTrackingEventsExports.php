<?php

namespace Innoboxrr\Deals\Exports;

use Innoboxrr\Deals\Models\DealLeadTrackingEvent;
use Innoboxrr\SearchSurge\Search\Builder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DealLeadTrackingEventsExports implements FromView
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
            ) . 'deal_lead_tracking_event', 
            [
                'deal_lead_tracking_events' => $this->getQuery(),
                'exportCols' => DealLeadTrackingEvent::$export_cols
            ]
        );
    }

    public function getQuery()
    {   
        $builder = new Builder();
        // lazy() en vez de get(): un export recorre la tabla entera y
        // hidratar todas las filas a la vez es lo que revienta la memoria.
        return $builder->lazy(DealLeadTrackingEvent::class, $this->data);
    }

}