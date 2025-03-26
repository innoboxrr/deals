<?php

namespace Innoboxrr\Deals\Models\Traits\Storage;

// use Innoboxrr\Deals\Models\DealAdvertiserPaymentMethodMeta;

trait DealAdvertiserPaymentMethodStorage
{

    public function createModel($request)
    {

        $dealAdvertiserPaymentMethod = $this->create($request->only($this->creatable));

        return $dealAdvertiserPaymentMethod;

    }

    public function updateModel($request)
    {
     
        $this->update($request->only($this->updatable));

        return $this;

    }

    /*
    public function updateModelMetas($request)
    {

        $this->update_metas($request, DealAdvertiserPaymentMethodMeta::class, 'deal_advertiser_payment_method_id')->updatePayload();

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