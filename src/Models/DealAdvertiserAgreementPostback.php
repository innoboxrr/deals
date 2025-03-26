<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\Deals\Models\Traits\Relations\DealAdvertiserAgreementPostbackRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealAdvertiserAgreementPostbackStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealAdvertiserAgreementPostbackAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealAdvertiserAgreementPostbackOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealAdvertiserAgreementPostbackMutators;

class DealAdvertiserAgreementPostback extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        DealAdvertiserAgreementPostbackRelations,
        DealAdvertiserAgreementPostbackStorage,
        DealAdvertiserAgreementPostbackAssignment,
        DealAdvertiserAgreementPostbackOperations,
        DealAdvertiserAgreementPostbackMutators;
        
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
        return \Innoboxrr\Deals\Database\Factories\DealAdvertiserAgreementPostbackFactory::new();
    }
    */

}
