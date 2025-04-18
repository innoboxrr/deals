<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\LaravelAudit\Support\Traits\Auditable;
use Innoboxrr\Deals\Models\Traits\Relations\DealAdvertiserRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealAdvertiserStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealAdvertiserAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealAdvertiserOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealAdvertiserMutators;
use Innoboxrr\Deals\Enums\DealAdvertiser\Status;

class DealAdvertiser extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        Auditable,
        DealAdvertiserRelations,
        DealAdvertiserStorage,
        DealAdvertiserAssignment,
        DealAdvertiserOperations,
        DealAdvertiserMutators;
        
    protected $fillable = [
        'status',
        'payload',
        'agent_id',
    ];
    
    protected $creatable = [
        'status',
        'payload',
        'agent_id',
    ];
    
    protected $updatable = [
        'status',
        'payload',
    ];
    
    protected $casts = [
        'status'    => Status::class,
        'payload'   => 'array',
        'agent_id'  => 'integer',
    ];
    
    protected $protected_metas = [];
    
    protected $editable_metas = [
        'settings_currency',
        'settings_language',
        'settings_timezone',
        'company_name',
        'company_tax_number',
        'company_tax_type',
        'billing_cfdi_use',
        'billing_payment_terms',
        'contracts',
        'address_name',
        'address_city',
        'address_state',
        'address_zip',
        'address_country',
        'documents_proof_of_address_url',
        'contacts',
        'web_website',
        'web_linkedin',
        'web_twitter',
        'web_facebook',
        'web_instagram',
        'web_youtube',
        'web_tiktok',
        'web_pinterest',
        'web_snapchat',
        'web_twitch',
        'web_whatsapp',
        'web_telegram',
        'web_discord',
        'bank_name',
        'bank_account',
        'bank_iban',
        'bank_swift',
        'last_invoice_number',
        'last_invoice_date',
        'last_invoice_amount',
        'compliance_verified',
        'compliance_verification_date',
        'compliance_verification_method',
        'activity_total_spent',
        'activity_campaigns_count',
        'activity_last_active',
    ];
    
    public static $export_cols = [
        'id',
        'status',
        'payload',
        'agent_id',
        'created_at',
        'updated_at',
    ];
        

    public static $loadable_relations = [
        'agent.user',
        'metas',
        'deal',
        'agreements',
        'paymentMethods',
        // 'agent', // Descomenta si el modelo Agent está implementado
    ];
    
    public static $loadable_counts = [
        'agreements',
        'paymentMethods',
    ];    

    /*
    protected static function newFactory()
    {
        return \Innoboxrr\Deals\Database\Factories\DealAdvertiserFactory::new();
    }
    */

}
