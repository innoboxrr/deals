<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserAgreementInvoice;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementInvoice;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserAgreementInvoiceResource;
use Innoboxrr\Deals\Http\Events\DealAdvertiserAgreementInvoice\Events\RestoreEvent;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RestoreRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $dealAdvertiserAgreementInvoice = DealAdvertiserAgreementInvoice::withTrashed()->findOrFail($this->deal_advertiser_agreement_invoice_id);
        
        return $this->user()->can('restore', $dealAdvertiserAgreementInvoice);

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

        $dealAdvertiserAgreementInvoice = DealAdvertiserAgreementInvoice::withTrashed()->findOrFail($this->deal_advertiser_agreement_invoice_id);

        $dealAdvertiserAgreementInvoice->restoreModel();

        $response = new DealAdvertiserAgreementInvoiceResource($dealAdvertiserAgreementInvoice);

        event(new RestoreEvent($dealAdvertiserAgreementInvoice, $this->all(), $response));

        return $response;

    }
    
}
