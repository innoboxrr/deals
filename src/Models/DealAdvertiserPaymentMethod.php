<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\Deals\Models\Traits\Relations\DealAdvertiserPaymentMethodRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealAdvertiserPaymentMethodStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealAdvertiserPaymentMethodAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealAdvertiserPaymentMethodOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealAdvertiserPaymentMethodMutators;

class DealAdvertiserPaymentMethod extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        DealAdvertiserPaymentMethodRelations,
        DealAdvertiserPaymentMethodStorage,
        DealAdvertiserPaymentMethodAssignment,
        DealAdvertiserPaymentMethodOperations,
        DealAdvertiserPaymentMethodMutators;
        
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
        return \Innoboxrr\Deals\Database\Factories\DealAdvertiserPaymentMethodFactory::new();
    }
    */

}
