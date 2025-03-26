<?php

namespace Innoboxrr\Deals\Models\Traits\Storage;

// use Innoboxrr\Deals\Models\DealAdvertiserAgreementDailyMeta;

trait DealAdvertiserAgreementDailyStorage
{

    public function createModel($request)
    {

        $dealAdvertiserAgreementDaily = $this->create($request->only($this->creatable));

        return $dealAdvertiserAgreementDaily;

    }

    public function updateModel($request)
    {
     
        $this->update($request->only($this->updatable));

        return $this;

    }

    /*
    public function updateModelMetas($request)
    {

        $this->update_metas($request, DealAdvertiserAgreementDailyMeta::class, 'deal_advertiser_agreement_daily_id')->updatePayload();

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