<?php

namespace Innoboxrr\Deals\Models\Traits\Storage;

// use Innoboxrr\Deals\Models\DealAdvertiserAgreementInvoiceMeta;

trait DealAdvertiserAgreementInvoiceStorage
{

    public function createModel($request)
    {

        $dealAdvertiserAgreementInvoice = $this->create($request->only($this->creatable));

        return $dealAdvertiserAgreementInvoice;

    }

    public function updateModel($request)
    {
     
        $this->update($request->only($this->updatable));

        return $this;

    }

    /*
    public function updateModelMetas($request)
    {

        $this->update_metas($request, DealAdvertiserAgreementInvoiceMeta::class, 'deal_advertiser_agreement_invoice_id')->updatePayload();

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