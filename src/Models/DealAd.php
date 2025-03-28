<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\Deals\Models\Traits\Relations\DealAdRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealAdStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealAdAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealAdOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealAdMutators;

class DealAd extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        DealAdRelations,
        DealAdStorage,
        DealAdAssignment,
        DealAdOperations,
        DealAdMutators;
    
    protected $fillable = [
        'name',
        'description',
        'payload',
        'deal_ad_group_id',
    ];

    protected $creatable = [
        'name',
        'description',
        'deal_ad_group_id',
    ];

    protected $updatable = [
        'name',
        'description',
    ];

    protected $casts = [
        'payload' => 'array',
    ];

    protected $protected_metas = [];

    protected $editable_metas = [
        //EDITABLEMETAS//
    ];

    public static $export_cols = [
        'id',
        'name',
        'description',
        'deal_ad_group_id',
        'created_at',
        'updated_at',
    ];

    public static $loadable_relations = [
        'metas',
        'adGroup',
        'performanceSnapshots',
    ];
    
    public static $loadable_counts = [
        'performanceSnapshots',
    ];    

    protected static function newFactory()
    {
        return \Innoboxrr\Deals\Database\Factories\DealAdFactory::new();
    }

}
