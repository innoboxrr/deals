<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserAgreementPostback;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementPostback;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserAgreementPostbackResource;
use Innoboxrr\Deals\Http\Events\DealAdvertiserAgreementPostback\Events\RestoreEvent;
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
        
        $dealAdvertiserAgreementPostback = DealAdvertiserAgreementPostback::withTrashed()->findOrFail($this->deal_advertiser_agreement_postback_id);
        
        return $this->user()->can('restore', $dealAdvertiserAgreementPostback);

    }

    public function rules()
    {
        return [
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

        $dealAdvertiserAgreementPostback = DealAdvertiserAgreementPostback::withTrashed()->findOrFail($this->deal_advertiser_agreement_postback_id);

        $dealAdvertiserAgreementPostback->restoreModel();

        $response = new DealAdvertiserAgreementPostbackResource($dealAdvertiserAgreementPostback);

        event(new RestoreEvent($dealAdvertiserAgreementPostback, $this->all(), $response));

        return $response;

    }
    
}
