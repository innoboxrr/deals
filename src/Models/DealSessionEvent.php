<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\Deals\Models\Traits\Relations\DealSessionEventRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealSessionEventStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealSessionEventAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealSessionEventOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealSessionEventMutators;

class DealSessionEvent extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        DealSessionEventRelations,
        DealSessionEventStorage,
        DealSessionEventAssignment,
        DealSessionEventOperations,
        DealSessionEventMutators;
        
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
        return \Innoboxrr\Deals\Database\Factories\DealSessionEventFactory::new();
    }
    */

}
