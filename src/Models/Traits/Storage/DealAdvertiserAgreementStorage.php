<?php

namespace Innoboxrr\Deals\Models\Traits\Storage;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementMeta;

trait DealAdvertiserAgreementStorage
{

    public function createModel($request)
    {

        $dealAdvertiserAgreement = $this->create($request->only($this->creatable));

        $dealAdvertiserAgreement->updateModelMetas($request);

        return $dealAdvertiserAgreement;

    }

    public function updateModel($request)
    {
     
        $this->update($request->only($this->updatable));

        $this->updateModelMetas($request);

        return $this;

    }

    public function updateModelMetas($request)
    {

        $this->update_metas($request, DealAdvertiserAgreementMeta::class, 'deal_advertiser_agreement_id')->updatePayload();

        return $this;

    }

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