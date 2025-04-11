<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\LaravelAudit\Support\Traits\Auditable;
use Innoboxrr\Deals\Models\Traits\Relations\DealRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealMutators;

class Deal extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        Auditable,
        DealRelations,
        DealStorage,
        DealAssignment,
        DealOperations,
        DealMutators;
        
    protected $fillable = [
        'name',
        'description',
        'payload',
        'workspace_id',
    ];

    protected $creatable = [
        'name',
        'description',
        'workspace_id',
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
        'max_cpl',
        'snapshot_cron_interval',
        'min_advertisers',
        'max_advertisers',
        'access_type',
        'automation_thresholds_min_ctr',
        'automation_thresholds_max_cpl',
        'automation_thresholds_max_cpa',
        'hypothesis_ctr',
        'hypothesis_cpl',
        'hypothesis_cpa',
        'hypothesis_conversion_rate',
        'hypothesis_leads_per_day',
        'hypothesis_roi',
        'alerts_emails',
        'alerts_phones',
        'segmentation_min_age',
        'segmentation_max_age',
        'segmentation_genders',
        'segmentation_languages',
        'segmentation_interests',
        'segmentation_locations',
        'segmentation_devices',
        'segmentation_platforms',
        'segmentation_behaviors',
        'currency',
        'objective',
        'type',
        'admin_fee_per_advertiser',
        'min_investment_per_advertiser',
        'investment_fee',
        'start_date',
        'restricted_countries',
        'auto_pause_campaigns_on_threshold',
    ];

    public static $export_cols = [
        'id',
        'name',
        'description',
        'workspace_id',
        'created_at',
        'updated_at',
    ];

    public static $loadable_relations = [
        'adPlatforms',
        'advertiser',
        // 'affiliateAgreements',
        // 'affiliateInvoices',
        'alerts',
        'gateways',
        'performanceSnapshots',
        'product',
        'metas',
        'router',
    ];

    public static $loadable_counts = [
        'adPlatforms',
        'advertiser',
        // 'affiliateAgreements',
        // 'affiliateInvoices',
        'alerts',
        'gateways',
        'performanceSnapshots',
        'product',
        'metas',
        'router',
    ];

    protected static function newFactory()
    {
        return \Innoboxrr\Deals\Database\Factories\DealFactory::new();
    }

}
