<?php

namespace Innoboxrr\Deals\Models\Traits\Storage;

// use Innoboxrr\Deals\Models\DealRouterMeta;

trait DealRouterStorage
{

    public function createModel($request)
    {

        $dealRouter = $this->create($request->only($this->creatable));

        return $dealRouter;

    }

    public function updateModel($request)
    {
     
        $this->update($request->only($this->updatable));

        return $this;

    }

    /*
    public function updateModelMetas($request)
    {

        $this->update_metas($request, DealRouterMeta::class, 'deal_router_id')->updatePayload();

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