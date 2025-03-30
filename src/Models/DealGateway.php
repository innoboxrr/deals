<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\LaravelAudit\Support\Traits\Auditable;
use Innoboxrr\Deals\Models\Traits\Relations\DealGatewayRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealGatewayStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealGatewayAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealGatewayOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealGatewayMutators;
use Innoboxrr\Deals\Enums\DealGateway\Status;

class DealGateway extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        Auditable,
        DealGatewayRelations,
        DealGatewayStorage,
        DealGatewayAssignment,
        DealGatewayOperations,
        DealGatewayMutators;
        
    protected $fillable = [
        'status',
        'deal_id',
        'gateway_type',
        'gateway_id',
    ];
    
    protected $creatable = [
        'status',
        'deal_id',
        'gateway_type',
        'gateway_id',
    ];
    
    protected $updatable = [
        'status',
        'deal_id',
        'gateway_type',
        'gateway_id',
    ];
    
    protected $casts = [
        'status'       => Status::class,
        'deal_id'      => 'integer',
        'gateway_id'   => 'integer',
    ];
    
    protected $protected_metas = [];
    
    protected $editable_metas = [
        //EDITABLEMETAS//
    ];
    
    public static $export_cols = [
        'id',
        'status',
        'deal_id',
        'gateway_type',
        'gateway_id',
        'created_at',
        'updated_at',
    ];

    public static $loadable_relations = [
        'deal',
        'sessions',
    ];
    
    public static $loadable_counts = [
        'sessions',
    ];    

    /*
    protected static function newFactory()
    {
        return \Innoboxrr\Deals\Database\Factories\DealGatewayFactory::new();
    }
    */

}
