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
        'start_date',
        'end_date',
        'autorenewal',
        'management_fee',
        'budget',
        'estimate_cpl',
        'net_budget',
        'leads_assigned',
        'deal_id',
        'deal_advertiser_id',
    ];
    
    protected $creatable = [
        'status',
        'payload',
        'start_date',
        'end_date',
        'autorenewal',
        'management_fee',
        'budget',
        'estimate_cpl',
        'net_budget',
        'leads_assigned',
        'deal_id',
        'deal_advertiser_id',
    ];
    
    protected $updatable = [
        'status',
        'payload',
        'start_date',
        'end_date',
        'autorenewal',
        'management_fee',
        'budget',
        'estimate_cpl',
        'net_budget',
        'leads_assigned',
    ];
    
    protected $casts = [
        'status'             => Status::class,
        'payload'            => 'array',
        'start_date'         => 'date',
        'end_date'           => 'date',
        'autorenewal'        => 'boolean',
        'management_fee'     => 'decimal:2',
        'budget'             => 'decimal:2',
        'estimate_cpl'       => 'decimal:2',
        'net_budget'         => 'decimal:2',
        'leads_assigned'     => 'integer',
        'deal_id'            => 'integer',
        'deal_advertiser_id' => 'integer',
    ];
    
    protected $protected_metas = [];
    
    protected $editable_metas = [
        //EDITABLEMETAS//
    ];
    
    public static $export_cols = [
        'id',
        'status',
        'payload',
        'start_date',
        'end_date',
        'autorenewal',
        'management_fee',
        'budget',
        'estimate_cpl',
        'net_budget',
        'leads_assigned',
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
