<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\Deals\Models\Traits\Relations\DealSessionRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealSessionStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealSessionAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealSessionOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealSessionMutators;

class DealSession extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        DealSessionRelations,
        DealSessionStorage,
        DealSessionAssignment,
        DealSessionOperations,
        DealSessionMutators;
        
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
        return \Innoboxrr\Deals\Database\Factories\DealSessionFactory::new();
    }
    */

}
