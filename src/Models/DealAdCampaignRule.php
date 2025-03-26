<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\Deals\Models\Traits\Relations\DealAdCampaignRuleRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealAdCampaignRuleStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealAdCampaignRuleAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealAdCampaignRuleOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealAdCampaignRuleMutators;

class DealAdCampaignRule extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        DealAdCampaignRuleRelations,
        DealAdCampaignRuleStorage,
        DealAdCampaignRuleAssignment,
        DealAdCampaignRuleOperations,
        DealAdCampaignRuleMutators;
        
    protected $fillable = [
        //FILLABLE//
    ];

    protected $creatable = [
        //CREATABLE//
    ];

    protected $updatable = [
        //UPDATABLE//
    ];

    protected $casts = [
        //CASTS//
    ];

    protected $protected_metas = [];

    protected $editable_metas = [
        //EDITABLEMETAS//
    ];

    public static $export_cols = [
        //EXPORTCOLS//
    ];

    public static $loadable_relations = [
        //LOADABLERELATIONS//
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
