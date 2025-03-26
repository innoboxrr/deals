<?php

namespace Innoboxrr\Deals\Models\Traits\Storage;

// use Innoboxrr\Deals\Models\DealAdvertiserAgreementPostbackMeta;

trait DealAdvertiserAgreementPostbackStorage
{

    public function createModel($request)
    {

        $dealAdvertiserAgreementPostback = $this->create($request->only($this->creatable));

        return $dealAdvertiserAgreementPostback;

    }

    public function updateModel($request)
    {
     
        $this->update($request->only($this->updatable));

        return $this;

    }

    /*
    public function updateModelMetas($request)
    {

        $this->update_metas($request, DealAdvertiserAgreementPostbackMeta::class, 'deal_advertiser_agreement_postback_id')->updatePayload();

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