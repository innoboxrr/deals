<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\LaravelAudit\Support\Traits\Auditable;
use Innoboxrr\Deals\Models\Traits\Relations\DealLeadRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealLeadStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealLeadAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealLeadOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealLeadMutators;
use Innoboxrr\Deals\Enums\DealLead\ConversionStage;
use Innoboxrr\Deals\Enums\DealLead\InterestLevel;
use Innoboxrr\Deals\Enums\DealLead\FraudRisk;
use Innoboxrr\Deals\Enums\DealLead\Gender;
use Innoboxrr\Deals\Enums\DealLead\Platform;

class DealLead extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        Auditable,
        DealLeadRelations,
        DealLeadStorage,
        DealLeadAssignment,
        DealLeadOperations,
        DealLeadMutators;
        
    protected $fillable = [
        'name',
        'email',
        'phone',
        'whatsapp',
        'gender',
        'birth_date',
        'address',
        'postalcode',
        'city',
        'state',
        'country',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_content',
        'utm_term',
        'ref',
        'ip',
        'platform',
        'traffic_id',
        'cpi',
        'assigned_at',
        'conversion_stage',
        'deal_gateway_id',
        'is_test',
        'duplicates_with',
        'notes',
        'source_verified_at',
        'time_on_page',
        'interaction_count',
        'form_steps_completed',
        'interest_level',
        'fraud_risk',
    ];
    
    protected $creatable = [
        'name',
        'email',
        'phone',
        'whatsapp',
        'gender',
        'birth_date',
        'address',
        'postalcode',
        'city',
        'state',
        'country',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_content',
        'utm_term',
        'ref',
        'ip',
        'platform',
        'traffic_id',
        'cpi',
        'assigned_at',
        'conversion_stage',
        'deal_gateway_id',
        'is_test',
        'duplicates_with',
        'notes',
        'source_verified_at',
        'time_on_page',
        'interaction_count',
        'form_steps_completed',
        'interest_level',
        'fraud_risk',
    ];
    
    protected $updatable = [
        'name',
        'email',
        'phone',
        'whatsapp',
        'gender',
        'birth_date',
        'address',
        'postalcode',
        'city',
        'state',
        'country',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_content',
        'utm_term',
        'ref',
        'ip',
        'platform',
        'traffic_id',
        'cpi',
        'assigned_at',
        'conversion_stage',
        'deal_gateway_id',
        'is_test',
        'duplicates_with',
        'notes',
        'source_verified_at',
        'time_on_page',
        'interaction_count',
        'form_steps_completed',
        'interest_level',
        'fraud_risk',
    ];
    
    protected $casts = [
        'conversion_stage'     => ConversionStage::class,
        'interest_level'       => InterestLevel::class,
        'gender'               => Gender::class,
        'fraud_risk'           => FraudRisk::class,
        'platform'             => Platform::class,
        'birth_date'           => 'date',
        'cpi'                  => 'decimal:2',
        'assigned_at'          => 'datetime',
        'is_test'              => 'boolean',
        'duplicates_with'      => 'array',
        'source_verified_at'   => 'datetime',
        'time_on_page'         => 'integer',
        'interaction_count'    => 'integer',
        'form_steps_completed' => 'integer',
        'deal_gateway_id'      => 'integer',
    ];
    
    protected $protected_metas = [];
    
    protected $editable_metas = [
        //EDITABLEMETAS//
    ];
    
    public static $export_cols = [
        'id',
        'name',
        'email',
        'phone',
        'whatsapp',
        'gender',
        'birth_date',
        'address',
        'postalcode',
        'city',
        'state',
        'country',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_content',
        'utm_term',
        'ref',
        'ip',
        'platform',
        'traffic_id',
        'cpi',
        'assigned_at',
        'conversion_stage',
        'deal_gateway_id',
        'is_test',
        'duplicates_with',
        'notes',
        'source_verified_at',
        'time_on_page',
        'interaction_count',
        'form_steps_completed',
        'interest_level',
        'fraud_risk',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
        

    public static $loadable_relations = [
        'dealGateway',
        'sessions',
        'postbacks',
        'trackingEvents',
    ];
    
    public static $loadable_counts = [
        'sessions',
        'postbacks',
        'trackingEvents',
    ];    

    /*
    protected static function newFactory()
    {
        return \Innoboxrr\Deals\Database\Factories\DealLeadFactory::new();
    }
    */

}
