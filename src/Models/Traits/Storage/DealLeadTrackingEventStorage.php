<?php

namespace Innoboxrr\Deals\Models\Traits\Storage;

// use Innoboxrr\Deals\Models\DealLeadTrackingEventMeta;

trait DealLeadTrackingEventStorage
{

    public function createModel($request)
    {

        $dealLeadTrackingEvent = $this->create($request->only($this->creatable));

        return $dealLeadTrackingEvent;

    }

    public function updateModel($request)
    {
     
        $this->update($request->only($this->updatable));

        return $this;

    }

    /*
    public function updateModelMetas($request)
    {

        $this->update_metas($request, DealLeadTrackingEventMeta::class, 'deal_lead_tracking_event_id')->updatePayload();

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