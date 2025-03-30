<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\LaravelAudit\Support\Traits\Auditable;
use Innoboxrr\Deals\Models\Traits\Relations\DealAdvertiserAgreementConfigRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealAdvertiserAgreementConfigStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealAdvertiserAgreementConfigAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealAdvertiserAgreementConfigOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealAdvertiserAgreementConfigMutators;

class DealAdvertiserAgreementConfig extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        Auditable,
        DealAdvertiserAgreementConfigRelations,
        DealAdvertiserAgreementConfigStorage,
        DealAdvertiserAgreementConfigAssignment,
        DealAdvertiserAgreementConfigOperations,
        DealAdvertiserAgreementConfigMutators;
        
    protected $fillable = [
        'payload',
        'deal_advertiser_agreement_id',
    ];
    
    protected $creatable = [
        'payload',
        'deal_advertiser_agreement_id',
    ];
    
    protected $updatable = [
        'payload',
    ];
    
    protected $casts = [
        'payload'                       => 'array',
        'deal_advertiser_agreement_id'  => 'integer',
    ];
    
    protected $protected_metas = [];
    
    protected $editable_metas = [
        //EDITABLEMETAS//
    ];
    
    public static $export_cols = [
        'id',
        'payload',
        'deal_advertiser_agreement_id',
        'created_at',
        'updated_at',
    ];
        

    public static $loadable_relations = [
        'metas',
        'advertiserAgreement',
    ];
    
    public static $loadable_counts = [
        // No relaciones hasMany con conteo útil en este caso.
    ];    

    /*
    protected static function newFactory()
    {
        return \Innoboxrr\Deals\Database\Factories\DealAdvertiserAgreementConfigFactory::new();
    }
    */

}
