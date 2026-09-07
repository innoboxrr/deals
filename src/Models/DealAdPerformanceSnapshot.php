<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\LaravelAudit\Support\Traits\Auditable;
use Innoboxrr\Deals\Models\Traits\Relations\DealAdPerformanceSnapshotRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealAdPerformanceSnapshotStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealAdPerformanceSnapshotAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealAdPerformanceSnapshotOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealAdPerformanceSnapshotMutators;

class DealAdPerformanceSnapshot extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        Auditable,
        DealAdPerformanceSnapshotRelations,
        DealAdPerformanceSnapshotStorage,
        DealAdPerformanceSnapshotAssignment,
        DealAdPerformanceSnapshotOperations,
        DealAdPerformanceSnapshotMutators;
        
    protected $fillable = [
        'from_date',
        'to_date',
        'impressions',
        'clicks',
        'leads',
        'spend',
        'cpl',
        'deal_ad_id',
    ];

    protected $creatable = [
        'from_date',
        'to_date',
        'impressions',
        'clicks',
        'leads',
        'spend',
        'cpl',
        'deal_ad_id',
    ];

    protected $updatable = [
        'from_date',
        'to_date',
        'impressions',
        'clicks',
        'leads',
        'spend',
        'cpl',
    ];

    protected $casts = [
        'from_date'    => 'integer',
        'to_date'      => 'integer',
        'impressions'  => 'integer',
        'clicks'       => 'integer',
        'leads'        => 'integer',
        'spend'        => 'decimal:2',
        'cpl'          => 'decimal:2',
        'deal_ad_id'   => 'integer',
    ];
    
    protected $protected_metas = [];
    
    protected $editable_metas = [
        //EDITABLEMETAS//
    ];
    
    public static $export_cols = [
        'id',
        'from_date',
        'to_date',
        'impressions',
        'clicks',
        'leads',
        'spend',
        'cpl',
        'deal_ad_id',
        'created_at',
        'updated_at',
    ];
    
    public static $loadable_relations = [
        'ad'
    ];

    public static $loadable_counts = [
        'ad'
    ];

    protected static function newFactory()
    {
        return \Innoboxrr\Deals\Database\Factories\DealAdPerformanceSnapshotFactory::new();
    }

}
