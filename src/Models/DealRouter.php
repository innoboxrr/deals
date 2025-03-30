<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\LaravelAudit\Support\Traits\Auditable;
use Innoboxrr\Deals\Models\Traits\Relations\DealRouterRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealRouterStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealRouterAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealRouterOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealRouterMutators;
use Innoboxrr\Deals\Enums\DealRouter\Queue;

class DealRouter extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        Auditable,
        DealRouterRelations,
        DealRouterStorage,
        DealRouterAssignment,
        DealRouterOperations,
        DealRouterMutators;
        
    protected $fillable = [
        'last_run',
        'queue',
        'deal_id',
    ];
    
    protected $creatable = [
        'last_run',
        'queue',
        'deal_id',
    ];
    
    protected $updatable = [
        'last_run',
        'queue',
        'deal_id',
    ];
    
    protected $casts = [
        'queue'    => Queue::class,
        'last_run' => 'datetime',
        'queue'    => 'array',
        'deal_id'  => 'integer',
    ];
    
    protected $protected_metas = [];
    
    protected $editable_metas = [
        //EDITABLEMETAS//
    ];
    
    public static $export_cols = [
        'id',
        'last_run',
        'queue',
        'deal_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];        

    public static $loadable_relations = [
        'deal',
        'executions',
    ];
    
    public static $loadable_counts = [
        'executions',
    ];    

    /*
    protected static function newFactory()
    {
        return \Innoboxrr\Deals\Database\Factories\DealRouterFactory::new();
    }
    */

}
