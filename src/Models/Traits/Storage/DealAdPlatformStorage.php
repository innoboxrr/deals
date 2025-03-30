<?php

namespace Innoboxrr\Deals\Models\Traits\Storage;

use Innoboxrr\Deals\Models\DealAdPlatformMeta;

trait DealAdPlatformStorage
{

    public function createModel($request)
    {

        $dealAdPlatform = $this->create($request->only($this->creatable));

        $dealAdPlatform->updateModelMetas($request);

        return $dealAdPlatform;

    }

    public function updateModel($request)
    {
     
        $this->update($request->only($this->updatable));

        $this->updateModelMetas($request);

        return $this;

    }

    public function updateModelMetas($request)
    {

        $this->update_metas($request, DealAdPlatformMeta::class, 'deal_ad_platform_id')->updatePayload();

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