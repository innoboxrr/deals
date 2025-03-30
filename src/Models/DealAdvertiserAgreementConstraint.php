<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\LaravelAudit\Support\Traits\Auditable;
use Innoboxrr\Deals\Models\Traits\Relations\DealAdvertiserAgreementConstraintRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealAdvertiserAgreementConstraintStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealAdvertiserAgreementConstraintAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealAdvertiserAgreementConstraintOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealAdvertiserAgreementConstraintMutators;
use Innoboxrr\Deals\Enums\DealAdvertiserAgreementConstraint\Operator;
use Innoboxrr\Deals\Enums\DealAdvertiserAgreementConstraint\Key;

class DealAdvertiserAgreementConstraint extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        Auditable,
        DealAdvertiserAgreementConstraintRelations,
        DealAdvertiserAgreementConstraintStorage,
        DealAdvertiserAgreementConstraintAssignment,
        DealAdvertiserAgreementConstraintOperations,
        DealAdvertiserAgreementConstraintMutators;
    
    protected $fillable = [
        'key',
        'operator',
        'value',
        'deal_advertiser_agreement_id',
    ];
    
    protected $creatable = [
        'key',
        'operator',
        'value',
        'deal_advertiser_agreement_id',
    ];
    
    protected $updatable = [
        'key',
        'operator',
        'value',
    ];
    
    protected $casts = [
        'key' => Key::class,
        'operator' => Operator::class,
        'deal_advertiser_agreement_id' => 'integer',
    ];
    
    protected $protected_metas = [];
    
    protected $editable_metas = [
        //EDITABLEMETAS//
    ];
    
    public static $export_cols = [
        'id',
        'key',
        'operator',
        'value',
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
        return \Innoboxrr\Deals\Database\Factories\DealAdvertiserAgreementConstraintFactory::new();
    }
    */

}
