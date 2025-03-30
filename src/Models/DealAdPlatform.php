<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\LaravelAudit\Support\Traits\Auditable;
use Innoboxrr\Deals\Models\Traits\Relations\DealAdPlatformRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealAdPlatformStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealAdPlatformAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealAdPlatformOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealAdPlatformMutators;

class DealAdPlatform extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        Auditable,
        DealAdPlatformRelations,
        DealAdPlatformStorage,
        DealAdPlatformAssignment,
        DealAdPlatformOperations,
        DealAdPlatformMutators;
        
    protected $fillable = [
        'name',
        'payload',
        'deal_id',
    ];
    
    protected $creatable = [
        'name',
        'payload',
        'deal_id',
    ];
    
    protected $updatable = [
        'name',
        'payload',
    ];
    
    protected $casts = [
        'payload' => 'array',
        'deal_id' => 'integer',
    ];
    
    protected $protected_metas = [];
    
    protected $editable_metas = [
        //EDITABLEMETAS//
    ];
    
    public static $export_cols = [
        'id',
        'name',
        'payload',
        'deal_id',
        'created_at',
        'updated_at',
    ];        

    public static $loadable_relations = [
        'metas',
        'deal',
        'adCampaigns',
    ];
    
    public static $loadable_counts = [
        'adCampaigns',
    ];    

    /*
    protected static function newFactory()
    {
        return \Innoboxrr\Deals\Database\Factories\DealAdPlatformFactory::new();
    }
    */

}
