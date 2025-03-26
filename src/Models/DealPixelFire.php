<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\Deals\Models\Traits\Relations\DealPixelFireRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealPixelFireStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealPixelFireAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealPixelFireOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealPixelFireMutators;

class DealPixelFire extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        DealPixelFireRelations,
        DealPixelFireStorage,
        DealPixelFireAssignment,
        DealPixelFireOperations,
        DealPixelFireMutators;
        
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
        return \Innoboxrr\Deals\Database\Factories\DealPixelFireFactory::new();
    }
    */

}
