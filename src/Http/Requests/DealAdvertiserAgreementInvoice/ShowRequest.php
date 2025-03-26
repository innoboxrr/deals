<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserAgreementInvoice;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementInvoice;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserAgreementInvoiceResource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShowRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {

        $dealAdvertiserAgreementInvoice = DealAdvertiserAgreementInvoice::findOrFail($this->deal_advertiser_agreement_invoice_id);

        return $this->user()->can('view', $dealAdvertiserAgreementInvoice);

    }

    public function rules()
    {
        return [
            'load_relations' => [
                'nullable',
                'array',
                Rule::in(DealAdvertiserAgreementInvoice::$loadable_relations)
            ],
            'load_counts' => [
                'nullable',
                'array',
                Rule::in(DealAdvertiserAgreementInvoice::$loadable_counts)
            ],
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

        $dealAdvertiserAgreementInvoice = DealAdvertiserAgreementInvoice::where('id', $this->deal_advertiser_agreement_invoice_id)
            ->with($this->load_relations ?? [])
            ->withCount($this->load_counts ?? [])
            ->firstOrFail();

        return new DealAdvertiserAgreementInvoiceResource($dealAdvertiserAgreementInvoice);

    }
    
}
