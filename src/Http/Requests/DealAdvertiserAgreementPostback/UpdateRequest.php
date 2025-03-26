<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserAgreementPostback;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementPostback;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserAgreementPostbackResource;
use Innoboxrr\Deals\Http\Events\DealAdvertiserAgreementPostback\Events\UpdateEvent;
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
        
        $dealAdvertiserAgreementPostback = DealAdvertiserAgreementPostback::findOrFail($this->deal_advertiser_agreement_postback_id);

        return $this->user()->can('update', $dealAdvertiserAgreementPostback);

    }

    public function rules()
    {
        return [
            //
            'deal_advertiser_agreement_postback_id' => 'required|numeric'
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

        $dealAdvertiserAgreementPostback = DealAdvertiserAgreementPostback::findOrFail($this->deal_advertiser_agreement_postback_id);

        $dealAdvertiserAgreementPostback = $dealAdvertiserAgreementPostback->updateModel($this);

        $response = new DealAdvertiserAgreementPostbackResource($dealAdvertiserAgreementPostback);

        event(new UpdateEvent($dealAdvertiserAgreementPostback, $this->all(), $response));

        return $response;

    }

}
