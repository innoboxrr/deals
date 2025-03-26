<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserAgreementConfig;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementConfig;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserAgreementConfigResource;
use Innoboxrr\Deals\Http\Events\DealAdvertiserAgreementConfig\Events\UpdateEvent;
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
        
        $dealAdvertiserAgreementConfig = DealAdvertiserAgreementConfig::findOrFail($this->deal_advertiser_agreement_config_id);

        return $this->user()->can('update', $dealAdvertiserAgreementConfig);

    }

    public function rules()
    {
        return [
            //
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

        $dealAdvertiserAgreementConfig = $dealAdvertiserAgreementConfig->updateModel($this);

        $response = new DealAdvertiserAgreementConfigResource($dealAdvertiserAgreementConfig);

        event(new UpdateEvent($dealAdvertiserAgreementConfig, $this->all(), $response));

        return $response;

    }

}
