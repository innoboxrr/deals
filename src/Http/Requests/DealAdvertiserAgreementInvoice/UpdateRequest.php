<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserAgreementInvoice;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementInvoice;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserAgreementInvoiceResource;
use Innoboxrr\Deals\Http\Events\DealAdvertiserAgreementInvoice\Events\UpdateEvent;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $dealAdvertiserAgreementInvoice = DealAdvertiserAgreementInvoice::findOrFail($this->deal_advertiser_agreement_invoice_id);

        return $this->user()->can('update', $dealAdvertiserAgreementInvoice);

    }

    public function rules()
    {
        return [
            //
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

        $dealAdvertiserAgreementInvoice = $dealAdvertiserAgreementInvoice->updateModel($this);

        $response = new DealAdvertiserAgreementInvoiceResource($dealAdvertiserAgreementInvoice);

        event(new UpdateEvent($dealAdvertiserAgreementInvoice, $this->all(), $response));

        return $response;

    }

}
