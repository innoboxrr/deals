<?php

namespace Innoboxrr\Deals\Models\Traits\Storage;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementConfigMeta;

trait DealAdvertiserAgreementConfigStorage
{

    public function createModel($request)
    {

        $dealAdvertiserAgreementConfig = $this->create($request->only($this->creatable));

        $dealAdvertiserAgreementConfig->updateModelMetas($request);

        return $dealAdvertiserAgreementConfig;

    }

    public function updateModel($request)
    {
     
        $this->update($request->only($this->updatable));

        $this->updateModelMetas($request);

        return $this;

    }

    public function updateModelMetas($request)
    {

        $this->update_metas($request, DealAdvertiserAgreementConfigMeta::class, 'deal_advertiser_agreement_config_id')->updatePayload();

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