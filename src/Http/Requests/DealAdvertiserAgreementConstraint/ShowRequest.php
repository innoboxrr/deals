<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserAgreementConstraint;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementConstraint;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserAgreementConstraintResource;
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

        $dealAdvertiserAgreementConstraint = DealAdvertiserAgreementConstraint::findOrFail($this->deal_advertiser_agreement_constraint_id);

        return $this->user()->can('view', $dealAdvertiserAgreementConstraint);

    }

    public function rules()
    {
        return [
            'load_relations' => [
                'nullable',
                'array',
                Rule::in(DealAdvertiserAgreementConstraint::$loadable_relations)
            ],
            'load_counts' => [
                'nullable',
                'array',
                Rule::in(DealAdvertiserAgreementConstraint::$loadable_counts)
            ],
            'deal_advertiser_agreement_constraint_id' => 'required|numeric'
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

        $dealAdvertiserAgreementConstraint = DealAdvertiserAgreementConstraint::where('id', $this->deal_advertiser_agreement_constraint_id)
            ->with($this->load_relations ?? [])
            ->withCount($this->load_counts ?? [])
            ->firstOrFail();

        return new DealAdvertiserAgreementConstraintResource($dealAdvertiserAgreementConstraint);

    }
    
}
