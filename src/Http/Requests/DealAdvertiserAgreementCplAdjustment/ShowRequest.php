<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserAgreementCplAdjustment;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementCplAdjustment;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserAgreementCplAdjustmentResource;
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

        $dealAdvertiserAgreementCplAdjustment = DealAdvertiserAgreementCplAdjustment::findOrFail($this->deal_advertiser_agreement_cpl_adjustment_id);

        return $this->user()->can('view', $dealAdvertiserAgreementCplAdjustment);

    }

    public function rules()
    {
        return [
            'load_relations' => [
                'nullable',
                'array',
                Rule::in(DealAdvertiserAgreementCplAdjustment::$loadable_relations)
            ],
            'load_counts' => [
                'nullable',
                'array',
                Rule::in(DealAdvertiserAgreementCplAdjustment::$loadable_counts)
            ],
            'deal_advertiser_agreement_cpl_adjustment_id' => 'required|numeric'
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

        $dealAdvertiserAgreementCplAdjustment = DealAdvertiserAgreementCplAdjustment::where('id', $this->deal_advertiser_agreement_cpl_adjustment_id)
            ->with($this->load_relations ?? [])
            ->withCount($this->load_counts ?? [])
            ->firstOrFail();

        return new DealAdvertiserAgreementCplAdjustmentResource($dealAdvertiserAgreementCplAdjustment);

    }
    
}
