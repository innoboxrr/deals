<?php

namespace Innoboxrr\Deals\Models\Traits\Storage;

// use Innoboxrr\Deals\Models\DealAdCampaignRuleMeta;

trait DealAdCampaignRuleStorage
{

    public function createModel($request)
    {

        $dealAdCampaignRule = $this->create($request->only($this->creatable));

        return $dealAdCampaignRule;

    }

    public function updateModel($request)
    {
     
        $this->update($request->only($this->updatable));

        return $this;

    }

    /*
    public function updateModelMetas($request)
    {

        $this->update_metas($request, DealAdCampaignRuleMeta::class, 'deal_ad_campaign_rule_id')->updatePayload();

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