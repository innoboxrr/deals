<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserAgreementIntegration;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementIntegration;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserAgreementIntegrationResource;
use Innoboxrr\Deals\Http\Events\DealAdvertiserAgreementIntegration\Events\DeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $dealAdvertiserAgreementIntegration = DealAdvertiserAgreementIntegration::findOrFail($this->deal_advertiser_agreement_integration_id);

        return $this->user()->can('delete', $dealAdvertiserAgreementIntegration);

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

        $dealAdvertiserAgreementIntegration = DealAdvertiserAgreementIntegration::findOrFail($this->deal_advertiser_agreement_integration_id);

        $dealAdvertiserAgreementIntegration->deleteModel();

        $response = new DealAdvertiserAgreementIntegrationResource($dealAdvertiserAgreementIntegration);

        event(new DeleteEvent($dealAdvertiserAgreementIntegration, $this->all(), $response));

        return $response;

    }
    
}
