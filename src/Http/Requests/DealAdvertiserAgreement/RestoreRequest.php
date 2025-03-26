<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserAgreement;

use Innoboxrr\Deals\Models\DealAdvertiserAgreement;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserAgreementResource;
use Innoboxrr\Deals\Http\Events\DealAdvertiserAgreement\Events\RestoreEvent;
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
        
        $dealAdvertiserAgreement = DealAdvertiserAgreement::withTrashed()->findOrFail($this->deal_advertiser_agreement_id);
        
        return $this->user()->can('restore', $dealAdvertiserAgreement);

    }

    public function rules()
    {
        return [
            'deal_advertiser_agreement_id' => 'required|numeric'
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

        $dealAdvertiserAgreement = DealAdvertiserAgreement::withTrashed()->findOrFail($this->deal_advertiser_agreement_id);

        $dealAdvertiserAgreement->restoreModel();

        $response = new DealAdvertiserAgreementResource($dealAdvertiserAgreement);

        event(new RestoreEvent($dealAdvertiserAgreement, $this->all(), $response));

        return $response;

    }
    
}
