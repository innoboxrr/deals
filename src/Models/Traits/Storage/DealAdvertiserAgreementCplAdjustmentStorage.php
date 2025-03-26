<?php

namespace Innoboxrr\Deals\Models\Traits\Storage;

// use Innoboxrr\Deals\Models\DealAdvertiserAgreementCplAdjustmentMeta;

trait DealAdvertiserAgreementCplAdjustmentStorage
{

    public function createModel($request)
    {

        $dealAdvertiserAgreementCplAdjustment = $this->create($request->only($this->creatable));

        return $dealAdvertiserAgreementCplAdjustment;

    }

    public function updateModel($request)
    {
     
        $this->update($request->only($this->updatable));

        return $this;

    }

    /*
    public function updateModelMetas($request)
    {

        $this->update_metas($request, DealAdvertiserAgreementCplAdjustmentMeta::class, 'deal_advertiser_agreement_cpl_adjustment_id')->updatePayload();

        return $this;

    }
    */

    public function deleteModel()
    {

        $this->delete();

    }

    public function restoreModel()
    {

        $this->restore();

    }

    public function forceDeleteModel()
    {

        abort(403);

        $this->forceDelete();
        
    }

}