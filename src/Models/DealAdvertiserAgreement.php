<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\LaravelAudit\Support\Traits\Auditable;
use Innoboxrr\Deals\Models\Traits\Relations\DealAdvertiserAgreementRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealAdvertiserAgreementStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealAdvertiserAgreementAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealAdvertiserAgreementOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealAdvertiserAgreementMutators;
use Innoboxrr\Deals\Enums\DealAdvertiserAgreement\Status;

class DealAdvertiserAgreement extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        Auditable,
        DealAdvertiserAgreementRelations,
        DealAdvertiserAgreementStorage,
        DealAdvertiserAgreementAssignment,
        DealAdvertiserAgreementOperations,
        DealAdvertiserAgreementMutators;
        
    protected $fillable = [
        'status',
        'payload',
        'deal_id',
        'deal_advertiser_id',
    ];
    
    protected $creatable = [
        'status',
        'payload',
        'deal_id',
        'deal_advertiser_id',
    ];
    
    protected $updatable = [
        'status',
        'payload',
    ];
    
    protected $casts = [
        'status'             => Status::class,
        'payload'            => 'array',
        'deal_id'            => 'integer',
        'deal_advertiser_id' => 'integer',
    ];
    
    protected $protected_metas = [];
    
    protected $editable_metas = [
        'general_start_date',
        'general_end_date',
        'general_contract_terms',
        'general_completion_notes',
        'general_direct_assignment_token',
        'general_timezone',
        'general_duplicate_lead_time',
        'general_lead_id_prefix',
        'general_default_country',
        'general_status',
        'billings_autorenewal',
        'billings_currency',
        'billings_management_fee',
        'billings_budget',
        'billings_budget_fee',
        'billings_net_budget',
        'billings_budget_spent',
        'billings_payment_terms',
        'billings_daily_budget',
        'billings_daily_budget_spent',
        'billings_invoice_reference',
        'billings_billing_name',
        'billings_billing_contact',
        'billings_billing_phone',
        'estimate_metrics_ctr',
        'estimate_metrics_cpl',
        'estimate_metrics_cpa',
        'estimate_metrics_conversion_rate',
        'estimate_metrics_leads_per_day',
        'estimate_metrics_roi',
        'estimate_metrics_lead_qualification_rate',
        'automation_pause_until',
        'automation_pause_reason',
        'automation_cpc',
        'automation_cpm',
        'automation_cpc_warn',
        'automation_cpc_critical',
        'automation_cpc_pause',
        'automation_cpm_warn',
        'automation_cpm_critical',
        'automation_cpm_pause',
        'automation_min_ctr',
        'automation_min_ctr_warn',
        'automation_min_ctr_critical',
        'automation_min_ctr_pause',
        'automation_min_conversion_rate',
        'automation_min_conversion_rate_warn',
        'automation_min_conversion_rate_critical',
        'automation_min_conversion_rate_pause',
        'automation_min_leads',
        'automation_min_leads_warn',
        'automation_min_leads_critical',
        'automation_min_leads_pause',
        'automation_max_leads',
        'automation_max_leads_warn',
        'automation_max_leads_critical',
        'automation_max_leads_pause',
        'automation_require_client_postback',
        'automation_postback_tolerance_hours',
        'automation_postback_tolerance_percentage',
        'automation_max_integration_errors',
        'automation_max_rejection_rate',
        'automation_cap_type',
        'automation_cap_value',
        'automation_cap_value_warn',
        'automation_cap_value_critical',
        'automation_cap_value_pause',
        'alerts_emails',
        'alerts_phones',
        'segmentation_platforms',
        'segmentation_interests',
        'segmentation_devices',
        'segmentation_states',
        'segmentation_min_age',
        'segmentation_max_age',
        'segmentation_genders',
        'segmentation_excluded_states',
        'segmentation_counties',
        'segmentation_excluded_postal_codes',
        'integration_calls',
        'postback_token',
        'postback_enabled',
        'postback_method',
        'postback_allowed_ips',
        'distribution_current_cpl',
        'distribution_current_cpa',
        'distribution_current_ctr',
        'distribution_current_cpm',
        'distribution_current_cpc',
        'distribution_current_leads_assigned',
        'distribution_current_leads_duplicates',
        'distribution_current_leads_waiting',
        'distribution_current_leads_rejected',
        'distribution_current_roi'
    ];    
    
    public static $export_cols = [
        'id',
        'status',
        'payload',
        'deal_id',
        'deal_advertiser_id',
        'created_at',
        'updated_at',
    ];        

    public static $loadable_relations = [
        'metas',
        'advertiser',
        'invoices',
        'constraints',
        'postbacks',
        'integrations',
        'configs',
        'dailies',
        'cplAdjustments',
        'deal',
    ];
    
    public static $loadable_counts = [
        'invoices',
        'constraints',
        'postbacks',
        'integrations',
        'configs',
        'dailies',
        'cplAdjustments',
        'deal'
    ];    

    /*
    protected static function newFactory()
    {
        return \Innoboxrr\Deals\Database\Factories\DealAdvertiserAgreementFactory::new();
    }
    */
}