<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\LaravelAudit\Support\Traits\Auditable;
use Innoboxrr\Deals\Models\Traits\Relations\DealPixelFireRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealPixelFireStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealPixelFireAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealPixelFireOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealPixelFireMutators;

class DealPixelFire extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        Auditable,
        DealPixelFireRelations,
        DealPixelFireStorage,
        DealPixelFireAssignment,
        DealPixelFireOperations,
        DealPixelFireMutators;
        
    protected $fillable = [
        'fired_at',
        'response',
        'platform_type',
        'platform_id',
        'deal_lead_tracking_event_id',
    ];
    
    protected $creatable = [
        'fired_at',
        'response',
        'platform_type',
        'platform_id',
        'deal_lead_tracking_event_id',
    ];
    
    protected $updatable = [
        'fired_at',
        'response',
        'platform_type',
        'platform_id',
        'deal_lead_tracking_event_id',
    ];
    
    protected $casts = [
        'fired_at'                   => 'datetime',
        'response'                   => 'array',
        'deal_lead_tracking_event_id'=> 'integer',
    ];
    
    protected $protected_metas = [];
    
    protected $editable_metas = [
        //EDITABLEMETAS//
    ];
    
    public static $export_cols = [
        'id',
        'fired_at',
        'response',
        'platform_type',
        'platform_id',
        'deal_lead_tracking_event_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];        

    public static $loadable_relations = [
        'trackingEvent',
        'adPlatform',
        // 'affiliate', // Descomenta si el modelo está implementado
    ];
    
    public static $loadable_counts = [
        // No relaciones hasMany que ameriten conteo.
    ];    

    /*
    protected static function newFactory()
    {
        return \Innoboxrr\Deals\Database\Factories\DealPixelFireFactory::new();
    }
    */

}
