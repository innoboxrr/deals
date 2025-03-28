<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\Deals\Models\Traits\Relations\DealAdvertiserAgreementPostbackRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealAdvertiserAgreementPostbackStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealAdvertiserAgreementPostbackAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealAdvertiserAgreementPostbackOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealAdvertiserAgreementPostbackMutators;

class DealAdvertiserAgreementPostback extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        DealAdvertiserAgreementPostbackRelations,
        DealAdvertiserAgreementPostbackStorage,
        DealAdvertiserAgreementPostbackAssignment,
        DealAdvertiserAgreementPostbackOperations,
        DealAdvertiserAgreementPostbackMutators;
        
    protected $fillable = [
        'request',
        'deal_lead_id',
        'deal_advertiser_agreement_id',
    ];
    
    protected $creatable = [
        'request',
        'deal_lead_id',
        'deal_advertiser_agreement_id',
    ];
    
    protected $updatable = [
        'request',
        'deal_lead_id',
    ];
    
    protected $casts = [
        'request'                      => 'array',
        'deal_lead_id'                 => 'integer',
        'deal_advertiser_agreement_id' => 'integer',
    ];
    
    protected $protected_metas = [];
    
    protected $editable_metas = [
        //EDITABLEMETAS//
    ];
    
    public static $export_cols = [
        'id',
        'request',
        'deal_lead_id',
        'deal_advertiser_agreement_id',
        'created_at',
        'updated_at',
    ];        

    public static $loadable_relations = [
        'advertiserAgreement',
        'lead',
    ];
    
    public static $loadable_counts = [
        // No relaciones tipo hasMany que ameriten conteo.
    ];    

    /*
    protected static function newFactory()
    {
        return \Innoboxrr\Deals\Database\Factories\DealAdvertiserAgreementPostbackFactory::new();
    }
    */

}
