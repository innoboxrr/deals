<?php

namespace Innoboxrr\Deals\Models\Traits\Storage;

// use Innoboxrr\Deals\Models\DealAdvertiserAgreementConstraintMeta;

trait DealAdvertiserAgreementConstraintStorage
{

    public function createModel($request)
    {

        $dealAdvertiserAgreementConstraint = $this->create($request->only($this->creatable));

        return $dealAdvertiserAgreementConstraint;

    }

    public function updateModel($request)
    {
     
        $this->update($request->only($this->updatable));

        return $this;

    }

    /*
    public function updateModelMetas($request)
    {

        $this->update_metas($request, DealAdvertiserAgreementConstraintMeta::class, 'deal_advertiser_agreement_constraint_id')->updatePayload();

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