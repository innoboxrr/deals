<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\Deals\Models\Traits\Relations\DealAdvertiserAgreementDailyRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealAdvertiserAgreementDailyStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealAdvertiserAgreementDailyAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealAdvertiserAgreementDailyOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealAdvertiserAgreementDailyMutators;

class DealAdvertiserAgreementDaily extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        DealAdvertiserAgreementDailyRelations,
        DealAdvertiserAgreementDailyStorage,
        DealAdvertiserAgreementDailyAssignment,
        DealAdvertiserAgreementDailyOperations,
        DealAdvertiserAgreementDailyMutators;
        
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
        return \Innoboxrr\Deals\Database\Factories\DealAdvertiserAgreementDailyFactory::new();
    }
    */

}
