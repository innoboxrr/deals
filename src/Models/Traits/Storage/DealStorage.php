<?php

namespace Innoboxrr\Deals\Models\Traits\Storage;

use Innoboxrr\Deals\Models\DealMeta;

trait DealStorage
{

    public function createModel($request)
    {

        $deal = $this->create($request->only($this->creatable));

        $deal->updateModelMetas($request);

        return $deal;

    }

    public function updateModel($request)
    {
     
        $this->update($request->only($this->updatable));

        $this->updateModelMetas($request);

        return $this;

    }

    public function updateModelMetas($request)
    {

        $this->update_metas($request, DealMeta::class, 'deal_id')->updatePayload();

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