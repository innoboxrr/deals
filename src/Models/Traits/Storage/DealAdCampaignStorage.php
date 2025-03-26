<?php

namespace Innoboxrr\Deals\Models\Traits\Storage;

// use Innoboxrr\Deals\Models\DealAdCampaignMeta;

trait DealAdCampaignStorage
{

    public function createModel($request)
    {

        $dealAdCampaign = $this->create($request->only($this->creatable));

        return $dealAdCampaign;

    }

    public function updateModel($request)
    {
     
        $this->update($request->only($this->updatable));

        return $this;

    }

    /*
    public function updateModelMetas($request)
    {

        $this->update_metas($request, DealAdCampaignMeta::class, 'deal_ad_campaign_id')->updatePayload();

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