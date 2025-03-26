<?php

namespace Innoboxrr\Deals\Exports;

use Innoboxrr\Deals\Models\DealPixelFire;
use Innoboxrr\SearchSurge\Search\Builder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DealPixelFiresExports implements FromView
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
            ) . 'deal_pixel_fire', 
            [
                'deal_pixel_fires' => $this->getQuery(),
                'exportCols' => DealPixelFire::$export_cols
            ]
        );
    }

    public function getQuery()
    {   
        $builder = new Builder();
        return $builder->get(DealPixelFire::class, $this->data);
    }

}