<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\LaravelAudit\Support\Traits\Auditable;
use Innoboxrr\Deals\Models\Traits\Relations\DealLeadRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealLeadStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealLeadAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealLeadOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealLeadMutators;
use Innoboxrr\Deals\Models\Traits\Scopes\DealLeadScopes;
use Innoboxrr\Deals\Enums\DealLead\Status;

class DealLead extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        Auditable,
        DealLeadRelations,
        DealLeadStorage,
        DealLeadAssignment,
        DealLeadOperations,
        DealLeadScopes,
        DealLeadMutators;
        
    protected $fillable = [
        'status',
        'payload',
        'lead_id',
        'log',
        'deal_gateway_id',
    ];
    
    protected $creatable = [
        'status',
        'payload',
        'lead_id',
        'log',
        'deal_gateway_id',
    ];
    
    protected $updatable = [
        'status',
        'payload',
        'lead_id',
        'log',
        'deal_gateway_id',
    ];
    
    protected $casts = [
        'status' => Status::class,
        'payload' => 'array',
        'lead_id' => 'string',
        'log' => 'array',
    ];
    
    protected $protected_metas = [];
    
    protected $editable_metas = [
        //EDITABLEMETAS//
    ];
    
    public static $export_cols = [
        'status',
        'lead_id',
        'deal_gateway_id',
    ];
        

    public static $loadable_relations = [
        'dealGateway',
        'sessions',
        'postbacks',
        'trackingEvents',
    ];
    
    public static $loadable_counts = [
        'sessions',
        'postbacks',
        'trackingEvents',
    ];    

    /*
    protected static function newFactory()
    {
        return \Innoboxrr\Deals\Database\Factories\DealLeadFactory::new();
    }
    */

}
