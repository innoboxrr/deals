<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserAgreementIntegration;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementIntegration;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserAgreementIntegrationResource;
use Innoboxrr\Deals\Http\Events\DealAdvertiserAgreementIntegration\Events\ForceDeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class ForceDeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {

        $dealAdvertiserAgreementIntegration = DealAdvertiserAgreementIntegration::withTrashed()->findOrFail($this->deal_advertiser_agreement_integration_id);
        
        return $this->user()->can('forceDelete', $dealAdvertiserAgreementIntegration);

    }

    public function rules()
    {
        return [
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

        $dealAdvertiserAgreementIntegration = DealAdvertiserAgreementIntegration::withTrashed()->findOrFail($this->deal_advertiser_agreement_integration_id);

        $dealAdvertiserAgreementIntegration->forceDeleteModel();

        $response = new DealAdvertiserAgreementIntegrationResource($dealAdvertiserAgreementIntegration);

        event(new ForceDeleteEvent($dealAdvertiserAgreementIntegration, $this->all(), $response));

        return $response;

    }
    
}
