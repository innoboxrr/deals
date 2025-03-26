<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserAgreementConfig;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementConfig;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserAgreementConfigResource;
use Innoboxrr\Deals\Http\Events\DealAdvertiserAgreementConfig\Events\DeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $dealAdvertiserAgreementConfig = DealAdvertiserAgreementConfig::findOrFail($this->deal_advertiser_agreement_config_id);

        return $this->user()->can('delete', $dealAdvertiserAgreementConfig);

    }

    public function rules()
    {
        return [
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

        $dealAdvertiserAgreementConfig = DealAdvertiserAgreementConfig::findOrFail($this->deal_advertiser_agreement_config_id);

        $dealAdvertiserAgreementConfig->deleteModel();

        $response = new DealAdvertiserAgreementConfigResource($dealAdvertiserAgreementConfig);

        event(new DeleteEvent($dealAdvertiserAgreementConfig, $this->all(), $response));

        return $response;

    }
    
}
