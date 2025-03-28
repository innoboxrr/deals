<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\Deals\Models\Traits\Relations\DealPerformanceSnapshotRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealPerformanceSnapshotStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealPerformanceSnapshotAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealPerformanceSnapshotOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealPerformanceSnapshotMutators;

class DealPerformanceSnapshot extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        DealPerformanceSnapshotRelations,
        DealPerformanceSnapshotStorage,
        DealPerformanceSnapshotAssignment,
        DealPerformanceSnapshotOperations,
        DealPerformanceSnapshotMutators;
        
    protected $fillable = [
        'time',
        'leads_generated',
        'leads_assigned',
        'avg_cpl',
        'avg_conversion_rate',
        'avg_roi',
        'deal_id',
    ];
    
    protected $creatable = [
        'time',
        'leads_generated',
        'leads_assigned',
        'avg_cpl',
        'avg_conversion_rate',
        'avg_roi',
        'deal_id',
    ];
    
    protected $updatable = [
        'time',
        'leads_generated',
        'leads_assigned',
        'avg_cpl',
        'avg_conversion_rate',
        'avg_roi',
    ];
    
    protected $casts = [
        'time'                 => 'integer',
        'leads_generated'      => 'integer',
        'leads_assigned'       => 'integer',
        'avg_cpl'              => 'decimal:2',
        'avg_conversion_rate'  => 'decimal:2',
        'avg_roi'              => 'decimal:2',
        'deal_id'              => 'integer',
    ];
    
    protected $protected_metas = [];
    
    protected $editable_metas = [
        //EDITABLEMETAS//
    ];
    
    public static $export_cols = [
        'id',
        'time',
        'leads_generated',
        'leads_assigned',
        'avg_cpl',
        'avg_conversion_rate',
        'avg_roi',
        'deal_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static $loadable_relations = [
        'deal'
    ];

    public static $loadable_counts = [
        'deal'
    ];

    /*
    protected static function newFactory()
    {
        return \Innoboxrr\Deals\Database\Factories\DealPerformanceSnapshotFactory::new();
    }
    */

}
