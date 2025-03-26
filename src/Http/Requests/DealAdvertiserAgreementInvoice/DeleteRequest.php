<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserAgreementInvoice;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementInvoice;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserAgreementInvoiceResource;
use Innoboxrr\Deals\Http\Events\DealAdvertiserAgreementInvoice\Events\DeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $dealAdvertiserAgreementInvoice = DealAdvertiserAgreementInvoice::findOrFail($this->deal_advertiser_agreement_invoice_id);

        return $this->user()->can('delete', $dealAdvertiserAgreementInvoice);

    }

    public function rules()
    {
        return [
            'deal_advertiser_agreement_invoice_id' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }

    public function attributes()
    {
        return [
            //
        ];
    }

    protected function passedValidation()
    {
        //
    }

    public function handle()
    {

        $dealAdvertiserAgreementInvoice = DealAdvertiserAgreementInvoice::findOrFail($this->deal_advertiser_agreement_invoice_id);

        $dealAdvertiserAgreementInvoice->deleteModel();

        $response = new DealAdvertiserAgreementInvoiceResource($dealAdvertiserAgreementInvoice);

        event(new DeleteEvent($dealAdvertiserAgreementInvoice, $this->all(), $response));

        return $response;

    }
    
}
