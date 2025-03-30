<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\LaravelAudit\Support\Traits\Auditable;
use Innoboxrr\Deals\Models\Traits\Relations\DealAlertRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealAlertStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealAlertAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealAlertOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealAlertMutators;
use Innoboxrr\Deals\Enums\DealAlert\Status;
use Innoboxrr\Deals\Enums\DealAlert\Type;

class DealAlert extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        Auditable,
        DealAlertRelations,
        DealAlertStorage,
        DealAlertAssignment,
        DealAlertOperations,
        DealAlertMutators;
    
    protected $fillable = [
        'type',
        'message',
        'status',
        'detected_at',
        'deal_id',
    ];
    
    protected $creatable = [
        'type',
        'message',
        'status',
        'detected_at',
        'deal_id',
    ];
    
    protected $updatable = [
        'type',
        'message',
        'status',
        'detected_at',
    ];
    
    protected $casts = [
        'type'        => Type::class,
        'status'      => Status::class,
        'detected_at' => 'datetime',
        'deal_id'     => 'integer',
    ];
    
    protected $protected_metas = [];
    
    protected $editable_metas = [
        //EDITABLEMETAS//
    ];
    
    public static $export_cols = [
        'id',
        'type',
        'message',
        'status',
        'detected_at',
        'deal_id',
        'created_at',
        'updated_at',
    ];        

    public static $loadable_relations = [
        'deal'
    ];

    public static $loadable_counts = [
        //LOADABLECOUNTS//
    ];

    /*
    protected static function newFactory()
    {
        return \Innoboxrr\Deals\Database\Factories\DealAlertFactory::new();
    }
    */

}
