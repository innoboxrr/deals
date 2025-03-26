<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserAgreementIntegration;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementIntegration;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserAgreementIntegrationResource;
use Innoboxrr\Deals\Http\Events\DealAdvertiserAgreementIntegration\Events\UpdateEvent;
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
        
        $dealAdvertiserAgreementIntegration = DealAdvertiserAgreementIntegration::findOrFail($this->deal_advertiser_agreement_integration_id);

        return $this->user()->can('update', $dealAdvertiserAgreementIntegration);

    }

    public function rules()
    {
        return [
            //
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

        $dealAdvertiserAgreementIntegration = DealAdvertiserAgreementIntegration::findOrFail($this->deal_advertiser_agreement_integration_id);

        $dealAdvertiserAgreementIntegration = $dealAdvertiserAgreementIntegration->updateModel($this);

        $response = new DealAdvertiserAgreementIntegrationResource($dealAdvertiserAgreementIntegration);

        event(new UpdateEvent($dealAdvertiserAgreementIntegration, $this->all(), $response));

        return $response;

    }

}
