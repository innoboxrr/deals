<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserAgreementConfig;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementConfig;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserAgreementConfigResource;
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

        $dealAdvertiserAgreementConfig = DealAdvertiserAgreementConfig::findOrFail($this->deal_advertiser_agreement_config_id);

        return $this->user()->can('view', $dealAdvertiserAgreementConfig);

    }

    public function rules()
    {
        return [
            'load_relations' => [
                'nullable',
                'array',
                Rule::in(DealAdvertiserAgreementConfig::$loadable_relations)
            ],
            'load_counts' => [
                'nullable',
                'array',
                Rule::in(DealAdvertiserAgreementConfig::$loadable_counts)
            ],
            'deal_advertiser_agreement_config_id' => 'required|numeric'
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

        $dealAdvertiserAgreementConfig = DealAdvertiserAgreementConfig::where('id', $this->deal_advertiser_agreement_config_id)
            ->with($this->load_relations ?? [])
            ->withCount($this->load_counts ?? [])
            ->firstOrFail();

        return new DealAdvertiserAgreementConfigResource($dealAdvertiserAgreementConfig);

    }
    
}
