<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\LaravelAudit\Support\Traits\Auditable;
use Innoboxrr\Deals\Models\Traits\Relations\DealAdvertiserAgreementInvoiceRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealAdvertiserAgreementInvoiceStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealAdvertiserAgreementInvoiceAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealAdvertiserAgreementInvoiceOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealAdvertiserAgreementInvoiceMutators;
use Innoboxrr\Deals\Enums\DealAdvertiserAgreementInvoice\Status;

class DealAdvertiserAgreementInvoice extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        Auditable,
        DealAdvertiserAgreementInvoiceRelations,
        DealAdvertiserAgreementInvoiceStorage,
        DealAdvertiserAgreementInvoiceAssignment,
        DealAdvertiserAgreementInvoiceOperations,
        DealAdvertiserAgreementInvoiceMutators;
        
    protected $fillable = [
        'status',
        'from_date',
        'to_date',
        'management_fee',
        'ad_spend',
        'tax',
        'total',
        'deal_advertiser_id',
        'deal_advertiser_agreement_id',
    ];
    
    protected $creatable = [
        'status',
        'from_date',
        'to_date',
        'management_fee',
        'ad_spend',
        'tax',
        'total',
        'deal_advertiser_id',
        'deal_advertiser_agreement_id',
    ];
    
    protected $updatable = [
        'status',
        'from_date',
        'to_date',
        'management_fee',
        'ad_spend',
        'tax',
        'total',
    ];
    
    protected $casts = [
        'status'                        => Status::class,
        'from_date'                    => 'date',
        'to_date'                      => 'date',
        'management_fee'               => 'decimal:2',
        'ad_spend'                     => 'decimal:2',
        'tax'                          => 'decimal:2',
        'total'                        => 'decimal:2',
        'deal_advertiser_id'           => 'integer',
        'deal_advertiser_agreement_id' => 'integer',
    ];
    
    protected $protected_metas = [];
    
    protected $editable_metas = [
        //EDITABLEMETAS//
    ];
    
    public static $export_cols = [
        'id',
        'status',
        'from_date',
        'to_date',
        'management_fee',
        'ad_spend',
        'tax',
        'total',
        'deal_advertiser_id',
        'deal_advertiser_agreement_id',
        'created_at',
        'updated_at',
    ];        

    public static $loadable_relations = [
        'advertiserAgreement',
        'advertiser',
    ];
    
    public static $loadable_counts = [
        // No relaciones tipo hasMany que ameriten conteo.
    ];    

    /*
    protected static function newFactory()
    {
        return \Innoboxrr\Deals\Database\Factories\DealAdvertiserAgreementInvoiceFactory::new();
    }
    */

}
