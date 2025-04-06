<?php

namespace Innoboxrr\Deals\Models\Traits\Storage;

use Innoboxrr\Deals\Models\DealProductMeta;

trait DealProductStorage
{

    public function createModel($request)
    {
        $dealProduct = $this->create($request->only($this->creatable));
        $dealProduct->updateModelMetas($request);
        return $dealProduct;
    }

    public function updateModel($request)
    {
        $this->update($request->only($this->updatable));
        $this->updateModelMetas($request);
        return $this;
    }

    public function updateModelMetas($request)
    {
        $this->update_metas($request, DealProductMeta::class, 'deal_product_id')->updatePayload();
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