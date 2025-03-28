<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\Deals\Models\Traits\Relations\DealAdvertiserRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealAdvertiserStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealAdvertiserAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealAdvertiserOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealAdvertiserMutators;

class DealAdvertiser extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        DealAdvertiserRelations,
        DealAdvertiserStorage,
        DealAdvertiserAssignment,
        DealAdvertiserOperations,
        DealAdvertiserMutators;
        
    protected $fillable = [
        'status',
        'payload',
        'deal_id',
        'agent_id',
    ];
    
    protected $creatable = [
        'status',
        'payload',
        'deal_id',
        'agent_id',
    ];
    
    protected $updatable = [
        'status',
        'payload',
    ];
    
    protected $casts = [
        'payload'   => 'array',
        'deal_id'   => 'integer',
        'agent_id'  => 'integer',
    ];
    
    protected $protected_metas = [];
    
    protected $editable_metas = [
        //EDITABLEMETAS//
    ];
    
    public static $export_cols = [
        'id',
        'status',
        'payload',
        'deal_id',
        'agent_id',
        'created_at',
        'updated_at',
    ];
        

    public static $loadable_relations = [
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
