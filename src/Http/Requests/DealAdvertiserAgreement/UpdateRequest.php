<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserAgreement;

use Innoboxrr\Deals\Models\DealAdvertiserAgreement;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserAgreementResource;
use Innoboxrr\Deals\Http\Events\DealAdvertiserAgreement\Events\UpdateEvent;
use Illuminate\Foundation\Http\FormRequest;
use Innoboxrr\Deals\Support\Utils\RequestFormater;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        RequestFormater::format($this);
    }

    public function authorize()
    {
        
        $dealAdvertiserAgreement = DealAdvertiserAgreement::findOrFail($this->deal_advertiser_agreement_id);

        return $this->user()->can('update', $dealAdvertiserAgreement);

    }

    public function rules()
    {
        return [
            //
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

        $dealAdvertiserAgreement = $dealAdvertiserAgreement->updateModel($this);

        $response = new DealAdvertiserAgreementResource($dealAdvertiserAgreement);

        event(new UpdateEvent($dealAdvertiserAgreement, $this->all(), $response));

        return $response;

    }

}
