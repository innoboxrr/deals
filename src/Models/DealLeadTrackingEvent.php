<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\Deals\Models\Traits\Relations\DealLeadTrackingEventRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealLeadTrackingEventStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealLeadTrackingEventAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealLeadTrackingEventOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealLeadTrackingEventMutators;

class DealLeadTrackingEvent extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        DealLeadTrackingEventRelations,
        DealLeadTrackingEventStorage,
        DealLeadTrackingEventAssignment,
        DealLeadTrackingEventOperations,
        DealLeadTrackingEventMutators;
        
    protected $fillable = [
        'event',
        'status',
        'data',
        'deal_lead_id',
    ];
    
    protected $creatable = [
        'event',
        'status',
        'data',
        'deal_lead_id',
    ];
    
    protected $updatable = [
        'event',
        'status',
        'data',
    ];
    
    protected $casts = [
        'data'         => 'array',
        'deal_lead_id' => 'integer',
    ];
    
    protected $protected_metas = [];
    
    protected $editable_metas = [
        //EDITABLEMETAS//
    ];
    
    public static $export_cols = [
        'id',
        'event',
        'status',
        'data',
        'deal_lead_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];        

    public static $loadable_relations = [
        'lead',
        'pixelFires',
    ];
    
    public static $loadable_counts = [
        'pixelFires',
    ];    

    /*
    protected static function newFactory()
    {
        return \Innoboxrr\Deals\Database\Factories\DealLeadTrackingEventFactory::new();
    }
    */

}
