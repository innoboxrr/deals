<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\LaravelAudit\Support\Traits\Auditable;
use Innoboxrr\Deals\Models\Traits\Relations\DealAdvertiserAgreementIntegrationRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealAdvertiserAgreementIntegrationStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealAdvertiserAgreementIntegrationAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealAdvertiserAgreementIntegrationOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealAdvertiserAgreementIntegrationMutators;

class DealAdvertiserAgreementIntegration extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        Auditable,
        DealAdvertiserAgreementIntegrationRelations,
        DealAdvertiserAgreementIntegrationStorage,
        DealAdvertiserAgreementIntegrationAssignment,
        DealAdvertiserAgreementIntegrationOperations,
        DealAdvertiserAgreementIntegrationMutators;
        
    protected $fillable = [
        'ping_config',
        'post_config',
        'postback_config',
        'deal_advertiser_agreement_id',
    ];
    
    protected $creatable = [
        'ping_config',
        'post_config',
        'postback_config',
        'deal_advertiser_agreement_id',
    ];
    
    protected $updatable = [
        'ping_config',
        'post_config',
        'postback_config',
    ];
    
    protected $casts = [
        'ping_config'                   => 'array',
        'post_config'                   => 'array',
        'postback_config'               => 'array',
        'deal_advertiser_agreement_id'  => 'integer',
    ];
    
    protected $protected_metas = [];
    
    protected $editable_metas = [
        //EDITABLEMETAS//
    ];
    
    public static $export_cols = [
        'id',
        'ping_config',
        'post_config',
        'postback_config',
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
        return \Innoboxrr\Deals\Database\Factories\DealAdvertiserAgreementIntegrationFactory::new();
    }
    */

}
