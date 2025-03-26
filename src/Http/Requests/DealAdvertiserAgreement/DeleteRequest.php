<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserAgreement;

use Innoboxrr\Deals\Models\DealAdvertiserAgreement;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserAgreementResource;
use Innoboxrr\Deals\Http\Events\DealAdvertiserAgreement\Events\DeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $dealAdvertiserAgreement = DealAdvertiserAgreement::findOrFail($this->deal_advertiser_agreement_id);

        return $this->user()->can('delete', $dealAdvertiserAgreement);

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

        $dealAdvertiserAgreement = DealAdvertiserAgreement::findOrFail($this->deal_advertiser_agreement_id);

        $dealAdvertiserAgreement->deleteModel();

        $response = new DealAdvertiserAgreementResource($dealAdvertiserAgreement);

        event(new DeleteEvent($dealAdvertiserAgreement, $this->all(), $response));

        return $response;

    }
    
}
