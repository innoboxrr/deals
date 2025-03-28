<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\Deals\Models\Traits\Relations\DealSessionEventRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealSessionEventStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealSessionEventAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealSessionEventOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealSessionEventMutators;

class DealSessionEvent extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        DealSessionEventRelations,
        DealSessionEventStorage,
        DealSessionEventAssignment,
        DealSessionEventOperations,
        DealSessionEventMutators;
        
    protected $fillable = [
        'key',
        'value',
        'deal_session_id',
    ];
    
    protected $creatable = [
        'key',
        'value',
        'deal_session_id',
    ];
    
    protected $updatable = [
        'key',
        'value',
        'deal_session_id',
    ];
    
    protected $casts = [
        'deal_session_id' => 'integer',
    ];
    
    protected $protected_metas = [];
    
    protected $editable_metas = [
        //EDITABLEMETAS//
    ];
    
    public static $export_cols = [
        'id',
        'key',
        'value',
        'deal_session_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];        

    public static $loadable_relations = [
        'session'
    ];

    public static $loadable_counts = [
        'session'
    ];

    /*
    protected static function newFactory()
    {
        return \Innoboxrr\Deals\Database\Factories\DealSessionEventFactory::new();
    }
    */

}
