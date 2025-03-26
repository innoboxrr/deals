<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserAgreementIntegration;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementIntegration;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserAgreementIntegrationResource;
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

        $dealAdvertiserAgreementIntegration = DealAdvertiserAgreementIntegration::findOrFail($this->deal_advertiser_agreement_integration_id);

        return $this->user()->can('view', $dealAdvertiserAgreementIntegration);

    }

    public function rules()
    {
        return [
            'load_relations' => [
                'nullable',
                'array',
                Rule::in(DealAdvertiserAgreementIntegration::$loadable_relations)
            ],
            'load_counts' => [
                'nullable',
                'array',
                Rule::in(DealAdvertiserAgreementIntegration::$loadable_counts)
            ],
            'deal_advertiser_agreement_integration_id' => 'required|numeric'
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

        $dealAdvertiserAgreementIntegration = DealAdvertiserAgreementIntegration::where('id', $this->deal_advertiser_agreement_integration_id)
            ->with($this->load_relations ?? [])
            ->withCount($this->load_counts ?? [])
            ->firstOrFail();

        return new DealAdvertiserAgreementIntegrationResource($dealAdvertiserAgreementIntegration);

    }
    
}
