<?php

namespace Innoboxrr\Deals\Models\Traits\Storage;

// use Innoboxrr\Deals\Models\DealAdPerformanceSnapshotMeta;

trait DealAdPerformanceSnapshotStorage
{

    public function createModel($request)
    {

        $dealAdPerformanceSnapshot = $this->create($request->only($this->creatable));

        return $dealAdPerformanceSnapshot;

    }

    public function updateModel($request)
    {
     
        $this->update($request->only($this->updatable));

        return $this;

    }

    /*
    public function updateModelMetas($request)
    {

        $this->update_metas($request, DealAdPerformanceSnapshotMeta::class, 'deal_ad_performance_snapshot_id')->updatePayload();

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