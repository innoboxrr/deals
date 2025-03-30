<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\LaravelAudit\Support\Traits\Auditable;
use Innoboxrr\Deals\Models\Traits\Relations\DealAdCampaignRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealAdCampaignStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealAdCampaignAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealAdCampaignOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealAdCampaignMutators;

class DealAdCampaign extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        Auditable,
        DealAdCampaignRelations,
        DealAdCampaignStorage,
        DealAdCampaignAssignment,
        DealAdCampaignOperations,
        DealAdCampaignMutators;
        
    protected $fillable = [
        'name',
        'payload',
        'deal_ad_platform_id',
    ];

    protected $creatable = [
        'name',
        'payload',
        'deal_ad_platform_id',
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
        'deal_ad_platform_id',
        'created_at',
        'updated_at',
    ];

    public static $loadable_relations = [
        'metas',
        'adPlatform',
        'adCampaignRules',
        'adGroups',
    ];
    
    public static $loadable_counts = [
        'adCampaignRules',
        'adGroups',
    ];    

    protected static function newFactory()
    {
        return \Innoboxrr\Deals\Database\Factories\DealAdCampaignFactory::new();
    }
}