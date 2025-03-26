<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\Deals\Models\Traits\Relations\DealGatewayRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealGatewayStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealGatewayAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealGatewayOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealGatewayMutators;

class DealGateway extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        DealGatewayRelations,
        DealGatewayStorage,
        DealGatewayAssignment,
        DealGatewayOperations,
        DealGatewayMutators;
        
    protected $fillable = [
        //FILLABLE//
    ];

    protected $creatable = [
        //CREATABLE//
    ];

    protected $updatable = [
        //UPDATABLE//
    ];

    protected $casts = [
        //CASTS//
    ];

    protected $protected_metas = [];

    protected $editable_metas = [
        //EDITABLEMETAS//
    ];

    public static $export_cols = [
        //EXPORTCOLS//
    ];

    public static $loadable_relations = [
        //LOADABLERELATIONS//
    ];

    public static $loadable_counts = [
        //LOADABLECOUNTS//
    ];

    /*
    protected static function newFactory()
    {
        return \Innoboxrr\Deals\Database\Factories\DealGatewayFactory::new();
    }
    */

}
