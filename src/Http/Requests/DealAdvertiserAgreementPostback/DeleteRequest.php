<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserAgreementPostback;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementPostback;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserAgreementPostbackResource;
use Innoboxrr\Deals\Http\Events\DealAdvertiserAgreementPostback\Events\DeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $dealAdvertiserAgreementPostback = DealAdvertiserAgreementPostback::findOrFail($this->deal_advertiser_agreement_postback_id);

        return $this->user()->can('delete', $dealAdvertiserAgreementPostback);

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

        $dealAdvertiserAgreementPostback = DealAdvertiserAgreementPostback::findOrFail($this->deal_advertiser_agreement_postback_id);

        $dealAdvertiserAgreementPostback->deleteModel();

        $response = new DealAdvertiserAgreementPostbackResource($dealAdvertiserAgreementPostback);

        event(new DeleteEvent($dealAdvertiserAgreementPostback, $this->all(), $response));

        return $response;

    }
    
}
