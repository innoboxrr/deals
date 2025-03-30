<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\LaravelAudit\Support\Traits\Auditable;
use Innoboxrr\Deals\Models\Traits\Relations\DealSessionRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealSessionStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealSessionAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealSessionOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealSessionMutators;

class DealSession extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        Auditable,
        DealSessionRelations,
        DealSessionStorage,
        DealSessionAssignment,
        DealSessionOperations,
        DealSessionMutators;
        
    protected $fillable = [
        'uuid',
        'deal_lead_id',
        'deal_gateway_id',
    ];
    
    protected $creatable = [
        'uuid',
        'deal_lead_id',
        'deal_gateway_id',
    ];
    
    protected $updatable = [
        'uuid',
        'deal_lead_id',
        'deal_gateway_id',
    ];
    
    protected $casts = [
        'deal_lead_id'    => 'integer',
        'deal_gateway_id'  => 'integer',
    ];
    
    protected $protected_metas = [];
    
    protected $editable_metas = [
        //EDITABLEMETAS//
    ];
    
    public static $export_cols = [
        'id',
        'uuid',
        'deal_lead_id',
        'deal_gateway_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
        
    public static $loadable_relations = [
        'lead',
        'gateway',
        'events',
    ];
    
    public static $loadable_counts = [
        'events',
    ];    

    /*
    protected static function newFactory()
    {
        return \Innoboxrr\Deals\Database\Factories\DealSessionFactory::new();
    }
    */

}
