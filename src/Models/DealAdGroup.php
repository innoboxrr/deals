<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\LaravelAudit\Support\Traits\Auditable;
use Innoboxrr\Deals\Models\Traits\Relations\DealAdGroupRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealAdGroupStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealAdGroupAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealAdGroupOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealAdGroupMutators;

class DealAdGroup extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        Auditable,
        DealAdGroupRelations,
        DealAdGroupStorage,
        DealAdGroupAssignment,
        DealAdGroupOperations,
        DealAdGroupMutators;
        
    protected $fillable = [
        'name',
        'payload',
        'deal_ad_campaign_id',
    ];

    protected $creatable = [
        'name',
        'payload',
        'deal_ad_campaign_id',
    ];

    protected $updatable = [
        'name',
        'payload',
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
        'payload',
        'deal_ad_campaign_id',
        'created_at',
        'updated_at',
    ];

    public static $loadable_relations = [
        'metas',
        'adCampaign',
        'ads',
    ];
    
    public static $loadable_counts = [
        'ads',
    ];    

    /*
    protected static function newFactory()
    {
        return \Innoboxrr\Deals\Database\Factories\DealAdGroupFactory::new();
    }
    */

}
