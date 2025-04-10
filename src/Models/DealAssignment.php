<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\LaravelAudit\Support\Traits\Auditable;
use Innoboxrr\Deals\Models\Traits\Relations\DealAssignmentRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealAssignmentStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealAssignmentAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealAssignmentOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealAssignmentMutators;

class DealAssignment extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        Auditable,
        DealAssignmentRelations,
        DealAssignmentStorage,
        DealAssignmentAssignment,
        DealAssignmentOperations,
        DealAssignmentMutators;
    
    protected $fillable = [
        'sent_object',
        'response',
        'deal_lead_id',
        'deal_advertiser_agreement_id',
        'deal_router_execution_id',
    ];
    
    protected $creatable = [
        'sent_object',
        'response',
        'deal_lead_id',
        'deal_advertiser_agreement_id',
        'deal_router_execution_id',
    ];
    
    protected $updatable = [
        'sent_object',
        'response',
        'deal_lead_id',
        'deal_advertiser_agreement_id',
        'deal_router_execution_id',
    ];
    
    protected $casts = [
        'sent_object'                  => 'array',
        'response'                     => 'array',
        'deal_lead_id'                 => 'integer',
        'deal_advertiser_agreement_id' => 'integer',
        'deal_router_execution_id'     => 'integer',
    ];
    
    protected $protected_metas = [];
    
    protected $editable_metas = [
        //EDITABLEMETAS//
    ];
    
    public static $export_cols = [
        'id',
        'sent_object',
        'response',
        'deal_lead_id',
        'deal_advertiser_agreement_id',
        'deal_router_execution_id',
        'created_at',
        'updated_at',
    ];
        
    public static $loadable_relations = [
        'lead',
        'advertiserAgreement',
        'routerExecution',
    ];
    
    public static $loadable_counts = [
        // No relaciones hasMany que ameriten conteo en este modelo.
    ];    

    /*
    protected static function newFactory()
    {
        return \Innoboxrr\Deals\Database\Factories\DealAssignmentFactory::new();
    }
    */

}
