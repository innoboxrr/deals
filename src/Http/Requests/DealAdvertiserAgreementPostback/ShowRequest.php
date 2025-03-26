<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserAgreementPostback;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementPostback;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserAgreementPostbackResource;
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

        $dealAdvertiserAgreementPostback = DealAdvertiserAgreementPostback::findOrFail($this->deal_advertiser_agreement_postback_id);

        return $this->user()->can('view', $dealAdvertiserAgreementPostback);

    }

    public function rules()
    {
        return [
            'load_relations' => [
                'nullable',
                'array',
                Rule::in(DealAdvertiserAgreementPostback::$loadable_relations)
            ],
            'load_counts' => [
                'nullable',
                'array',
                Rule::in(DealAdvertiserAgreementPostback::$loadable_counts)
            ],
            'deal_advertiser_agreement_postback_id' => 'required|numeric'
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

        $dealAdvertiserAgreementPostback = DealAdvertiserAgreementPostback::where('id', $this->deal_advertiser_agreement_postback_id)
            ->with($this->load_relations ?? [])
            ->withCount($this->load_counts ?? [])
            ->firstOrFail();

        return new DealAdvertiserAgreementPostbackResource($dealAdvertiserAgreementPostback);

    }
    
}
