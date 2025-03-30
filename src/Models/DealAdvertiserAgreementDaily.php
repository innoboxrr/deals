<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\LaravelAudit\Support\Traits\Auditable;
use Innoboxrr\Deals\Models\Traits\Relations\DealAdvertiserAgreementDailyRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealAdvertiserAgreementDailyStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealAdvertiserAgreementDailyAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealAdvertiserAgreementDailyOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealAdvertiserAgreementDailyMutators;

class DealAdvertiserAgreementDaily extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        Auditable,
        DealAdvertiserAgreementDailyRelations,
        DealAdvertiserAgreementDailyStorage,
        DealAdvertiserAgreementDailyAssignment,
        DealAdvertiserAgreementDailyOperations,
        DealAdvertiserAgreementDailyMutators;
        
    protected $fillable = [
        'date',
        'start_hour',
        'end_hour',
        'cpl',
        'budget',
        'spent',
        'progress',
        'leads_assigned',
        'deal_advertiser_agreement_id',
    ];

    protected $creatable = [
        'date',
        'start_hour',
        'end_hour',
        'cpl',
        'budget',
        'spent',
        'progress',
        'leads_assigned',
        'deal_advertiser_agreement_id',
    ];

    protected $updatable = [
        'date',
        'start_hour',
        'end_hour',
        'cpl',
        'budget',
        'spent',
        'progress',
        'leads_assigned',
    ];

    protected $casts = [
        'date'                         => 'date',
        'start_hour'                   => 'string',
        'end_hour'                     => 'string',
        'cpl'                          => 'decimal:2',
        'budget'                       => 'decimal:2',
        'spent'                        => 'decimal:2',
        'progress'                     => 'decimal:2',
        'leads_assigned'               => 'integer',
        'deal_advertiser_agreement_id' => 'integer',
    ];

    protected $protected_metas = [];

    protected $editable_metas = [
        //EDITABLEMETAS//
    ];

    public static $export_cols = [
        'id',
        'date',
        'start_hour',
        'end_hour',
        'cpl',
        'budget',
        'spent',
        'progress',
        'leads_assigned',
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
        return \Innoboxrr\Deals\Database\Factories\DealAdvertiserAgreementDailyFactory::new();
    }
    */

}
