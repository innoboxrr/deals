<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserAgreementConstraint;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementConstraint;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserAgreementConstraintResource;
use Innoboxrr\Deals\Http\Events\DealAdvertiserAgreementConstraint\Events\RestoreEvent;
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
        
        $dealAdvertiserAgreementConstraint = DealAdvertiserAgreementConstraint::withTrashed()->findOrFail($this->deal_advertiser_agreement_constraint_id);
        
        return $this->user()->can('restore', $dealAdvertiserAgreementConstraint);

    }

    public function rules()
    {
        return [
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

        $dealAdvertiserAgreementConstraint = DealAdvertiserAgreementConstraint::withTrashed()->findOrFail($this->deal_advertiser_agreement_constraint_id);

        $dealAdvertiserAgreementConstraint->restoreModel();

        $response = new DealAdvertiserAgreementConstraintResource($dealAdvertiserAgreementConstraint);

        event(new RestoreEvent($dealAdvertiserAgreementConstraint, $this->all(), $response));

        return $response;

    }
    
}
