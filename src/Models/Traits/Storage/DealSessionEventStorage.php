<?php

namespace Innoboxrr\Deals\Models\Traits\Storage;

// use Innoboxrr\Deals\Models\DealSessionEventMeta;

trait DealSessionEventStorage
{

    public function createModel($request)
    {

        $dealSessionEvent = $this->create($request->only($this->creatable));

        return $dealSessionEvent;

    }

    public function updateModel($request)
    {
     
        $this->update($request->only($this->updatable));

        return $this;

    }

    /*
    public function updateModelMetas($request)
    {

        $this->update_metas($request, DealSessionEventMeta::class, 'deal_session_event_id')->updatePayload();

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