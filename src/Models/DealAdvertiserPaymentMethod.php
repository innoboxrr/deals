<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\LaravelAudit\Support\Traits\Auditable;
use Innoboxrr\Deals\Models\Traits\Relations\DealAdvertiserPaymentMethodRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealAdvertiserPaymentMethodStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealAdvertiserPaymentMethodAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealAdvertiserPaymentMethodOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealAdvertiserPaymentMethodMutators;
use Innoboxrr\Deals\Enums\DealAdvertiserPaymentMethod\Status;
use Innoboxrr\Deals\Enums\DealAdvertiserPaymentMethod\Processor;

class DealAdvertiserPaymentMethod extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        Auditable,
        DealAdvertiserPaymentMethodRelations,
        DealAdvertiserPaymentMethodStorage,
        DealAdvertiserPaymentMethodAssignment,
        DealAdvertiserPaymentMethodOperations,
        DealAdvertiserPaymentMethodMutators;
    
    protected $fillable = [
        'processor',
        'processor_id',
        'processor_date',
        'status',
        'main',
        'deal_advertiser_id',
    ];
    
    protected $creatable = [
        'processor',
        'processor_id',
        'processor_date',
        'status',
        'main',
        'deal_advertiser_id',
    ];
    
    protected $updatable = [
        'processor',
        'processor_id',
        'processor_date',
        'status',
        'main',
    ];
    
    protected $casts = [
        'status'              => Status::class,
        'processor'           => Processor::class,
        'processor_date'       => 'datetime',
        'main'                 => 'boolean',
        'deal_advertiser_id'   => 'integer',
    ];
    
    protected $protected_metas = [];
    
    protected $editable_metas = [
        //EDITABLEMETAS//
    ];
    
    public static $export_cols = [
        'id',
        'processor',
        'processor_id',
        'processor_date',
        'status',
        'main',
        'deal_advertiser_id',
        'created_at',
        'updated_at',
    ];

    public static $loadable_relations = [
        'advertiser'
    ];

    public static $loadable_counts = [
        //LOADABLECOUNTS//
    ];

    /*
    protected static function newFactory()
    {
        return \Innoboxrr\Deals\Database\Factories\DealAdvertiserPaymentMethodFactory::new();
    }
    */

}
