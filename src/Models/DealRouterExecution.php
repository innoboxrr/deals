<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\Deals\Models\Traits\Relations\DealRouterExecutionRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealRouterExecutionStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealRouterExecutionAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealRouterExecutionOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealRouterExecutionMutators;

class DealRouterExecution extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        DealRouterExecutionRelations,
        DealRouterExecutionStorage,
        DealRouterExecutionAssignment,
        DealRouterExecutionOperations,
        DealRouterExecutionMutators;
        
    protected $fillable = [
        'start_execution',
        'end_execution',
        'assignment_log',
        'deal_router_id',
    ];
    
    protected $creatable = [
        'start_execution',
        'end_execution',
        'assignment_log',
        'deal_router_id',
    ];
    
    protected $updatable = [
        'start_execution',
        'end_execution',
        'assignment_log',
        'deal_router_id',
    ];
    
    protected $casts = [
        'start_execution' => 'datetime',
        'end_execution'   => 'datetime',
        'assignment_log'  => 'array',
        'deal_router_id'  => 'integer',
    ];
    
    protected $protected_metas = [];
    
    protected $editable_metas = [
        //EDITABLEMETAS//
    ];
    
    public static $export_cols = [
        'id',
        'start_execution',
        'end_execution',
        'assignment_log',
        'deal_router_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];        

    public static $loadable_relations = [
        'router',
        'assignments',
    ];
    
    public static $loadable_counts = [
        'assignments',
    ];    

    /*
    protected static function newFactory()
    {
        return \Innoboxrr\Deals\Database\Factories\DealRouterExecutionFactory::new();
    }
    */

}
