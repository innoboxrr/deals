<?php

namespace Innoboxrr\Deals\Models\Traits\Storage;

// use Innoboxrr\Deals\Models\DealAdvertiserAgreementIntegrationMeta;

trait DealAdvertiserAgreementIntegrationStorage
{

    public function createModel($request)
    {

        $dealAdvertiserAgreementIntegration = $this->create($request->only($this->creatable));

        return $dealAdvertiserAgreementIntegration;

    }

    public function updateModel($request)
    {
     
        $this->update($request->only($this->updatable));

        return $this;

    }

    /*
    public function updateModelMetas($request)
    {

        $this->update_metas($request, DealAdvertiserAgreementIntegrationMeta::class, 'deal_advertiser_agreement_integration_id')->updatePayload();

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