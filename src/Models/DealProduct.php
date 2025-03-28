<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\Deals\Models\Traits\Relations\DealProductRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealProductStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealProductAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealProductOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealProductMutators;

class DealProduct extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        DealProductRelations,
        DealProductStorage,
        DealProductAssignment,
        DealProductOperations,
        DealProductMutators;
        
    protected $fillable = [
        'name',
        'description',
        'payload',
        'deal_id',
    ];
    
    protected $creatable = [
        'name',
        'description',
        'payload',
        'deal_id',
    ];
    
    protected $updatable = [
        'name',
        'description',
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
        'description',
        'payload',
        'deal_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];        

    public static $loadable_relations = [
        'deal',
        'metas',
    ];
    
    public static $loadable_counts = [
        'metas',
    ];    

    /*
    protected static function newFactory()
    {
        return \Innoboxrr\Deals\Database\Factories\DealProductFactory::new();
    }
    */

}
