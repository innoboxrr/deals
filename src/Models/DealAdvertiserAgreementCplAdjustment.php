<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\Deals\Models\Traits\Relations\DealAdvertiserAgreementCplAdjustmentRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealAdvertiserAgreementCplAdjustmentStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealAdvertiserAgreementCplAdjustmentAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealAdvertiserAgreementCplAdjustmentOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealAdvertiserAgreementCplAdjustmentMutators;

class DealAdvertiserAgreementCplAdjustment extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        DealAdvertiserAgreementCplAdjustmentRelations,
        DealAdvertiserAgreementCplAdjustmentStorage,
        DealAdvertiserAgreementCplAdjustmentAssignment,
        DealAdvertiserAgreementCplAdjustmentOperations,
        DealAdvertiserAgreementCplAdjustmentMutators;
        
    protected $fillable = [
        'before',
        'after',
        'deal_cpl_monitor_run_io',
        'deal_advertiser_agreement_id',
    ];
    
    protected $creatable = [
        'before',
        'after',
        'deal_cpl_monitor_run_io',
        'deal_advertiser_agreement_id',
    ];
    
    protected $updatable = [
        'before',
        'after',
        'deal_cpl_monitor_run_io',
    ];
    
    protected $casts = [
        'before'                       => 'decimal:2',
        'after'                        => 'decimal:2',
        'deal_cpl_monitor_run_io'      => 'string',
        'deal_advertiser_agreement_id' => 'integer',
    ];
    
    protected $protected_metas = [];
    
    protected $editable_metas = [
        //EDITABLEMETAS//
    ];
    
    public static $export_cols = [
        'id',
        'before',
        'after',
        'deal_cpl_monitor_run_io',
        'deal_advertiser_agreement_id',
        'created_at',
        'updated_at',
    ];        

    public static $loadable_relations = [
        'advertiserAgreement'
    ];

    public static $loadable_counts = [
        'advertiserAgreement'
    ];

    /*
    protected static function newFactory()
    {
        return \Innoboxrr\Deals\Database\Factories\DealAdvertiserAgreementCplAdjustmentFactory::new();
    }
    */

}
