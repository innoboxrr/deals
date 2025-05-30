<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\LaravelAudit\Support\Traits\Auditable;
use Innoboxrr\Deals\Models\Traits\Relations\DealAdCampaignRuleRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealAdCampaignRuleStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealAdCampaignRuleAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealAdCampaignRuleOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealAdCampaignRuleMutators;
use Innoboxrr\Deals\Enums\DealAdCampaignRule\ConditionType;
use Innoboxrr\Deals\Enums\DealAdCampaignRule\Action;

class DealAdCampaignRule extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        Auditable,
        DealAdCampaignRuleRelations,
        DealAdCampaignRuleStorage,
        DealAdCampaignRuleAssignment,
        DealAdCampaignRuleOperations,
        DealAdCampaignRuleMutators;
        
    protected $fillable = [
        'condition_type',
        'value',
        'action',
        'deal_ad_campaign_id',
    ];

    protected $creatable = [
        'condition_type',
        'value',
        'action',
        'deal_ad_campaign_id',
    ];

    protected $updatable = [
        'condition_type',
        'value',
        'action',
    ];

    protected $casts = [
        'condition_type' => ConditionType::class,
        'value' => 'string',
        'action' => Action::class,
        'deal_ad_campaign_id' => 'integer',
    ];

    protected $protected_metas = [];

    protected $editable_metas = [
        //EDITABLEMETAS//
    ];

    public static $export_cols = [
        'id',
        'condition_type',
        'value',
        'action',
        'deal_ad_campaign_id',
        'created_at',
        'updated_at',
    ];

    public static $loadable_relations = [
        'adCampaign',
    ];

    public static $loadable_counts = [
        //LOADABLECOUNTS//
    ];

    /*
    protected static function newFactory()
    {
        return \Innoboxrr\Deals\Database\Factories\DealAdCampaignRuleFactory::new();
    }
    */

}
