<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\Deals\Models\Traits\Relations\DealLeadRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealLeadStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealLeadAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealLeadOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealLeadMutators;

class DealLead extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
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
        'birth_date'           => 'date',
        'cpi'                  => 'decimal:2',
        'assigned_at'          => 'datetime',
        'is_test'              => 'boolean',
        'duplicates_with'      => 'array',
        'source_verified_at'   => 'datetime',
        'time_on_page'         => 'integer',
        'interaction_count'    => 'integer',
        'form_steps_completed' => 'integer',
        'interest_level'       => 'integer',
        'fraud_risk'           => 'integer',
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
