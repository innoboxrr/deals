<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserAgreementConstraint;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementConstraint;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserAgreementConstraintResource;
use Innoboxrr\Deals\Http\Events\DealAdvertiserAgreementConstraint\Events\DeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $dealAdvertiserAgreementConstraint = DealAdvertiserAgreementConstraint::findOrFail($this->deal_advertiser_agreement_constraint_id);

        return $this->user()->can('delete', $dealAdvertiserAgreementConstraint);

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

        $dealAdvertiserAgreementConstraint = DealAdvertiserAgreementConstraint::findOrFail($this->deal_advertiser_agreement_constraint_id);

        $dealAdvertiserAgreementConstraint->deleteModel();

        $response = new DealAdvertiserAgreementConstraintResource($dealAdvertiserAgreementConstraint);

        event(new DeleteEvent($dealAdvertiserAgreementConstraint, $this->all(), $response));

        return $response;

    }
    
}
