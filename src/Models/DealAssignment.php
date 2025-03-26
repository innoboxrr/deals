<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
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
        DealAssignmentRelations,
        DealAssignmentStorage,
        DealAssignmentAssignment,
        DealAssignmentOperations,
        DealAssignmentMutators;
        
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
        return \Innoboxrr\Deals\Database\Factories\DealAssignmentFactory::new();
    }
    */

}
