<?php

namespace Innoboxrr\Deals\Models\Traits\Storage;

// use Innoboxrr\Deals\Models\DealRouterExecutionMeta;

trait DealRouterExecutionStorage
{

    public function createModel($request)
    {

        $dealRouterExecution = $this->create($request->only($this->creatable));

        return $dealRouterExecution;

    }

    public function updateModel($request)
    {
     
        $this->update($request->only($this->updatable));

        return $this;

    }

    /*
    public function updateModelMetas($request)
    {

        $this->update_metas($request, DealRouterExecutionMeta::class, 'deal_router_execution_id')->updatePayload();

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