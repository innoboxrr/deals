<?php

namespace Innoboxrr\Deals\Models\Traits\Storage;

// use Innoboxrr\Deals\Models\DealPerformanceSnapshotMeta;

trait DealPerformanceSnapshotStorage
{

    public function createModel($request)
    {

        $dealPerformanceSnapshot = $this->create($request->only($this->creatable));

        return $dealPerformanceSnapshot;

    }

    public function updateModel($request)
    {
     
        $this->update($request->only($this->updatable));

        return $this;

    }

    /*
    public function updateModelMetas($request)
    {

        $this->update_metas($request, DealPerformanceSnapshotMeta::class, 'deal_performance_snapshot_id')->updatePayload();

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