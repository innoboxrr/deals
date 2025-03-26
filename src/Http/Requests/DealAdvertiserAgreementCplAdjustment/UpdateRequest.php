<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserAgreementCplAdjustment;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementCplAdjustment;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserAgreementCplAdjustmentResource;
use Innoboxrr\Deals\Http\Events\DealAdvertiserAgreementCplAdjustment\Events\UpdateEvent;
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
        
        $dealAdvertiserAgreementCplAdjustment = DealAdvertiserAgreementCplAdjustment::findOrFail($this->deal_advertiser_agreement_cpl_adjustment_id);

        return $this->user()->can('update', $dealAdvertiserAgreementCplAdjustment);

    }

    public function rules()
    {
        return [
            //
            'deal_advertiser_agreement_cpl_adjustment_id' => 'required|numeric'
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

        $dealAdvertiserAgreementCplAdjustment = DealAdvertiserAgreementCplAdjustment::findOrFail($this->deal_advertiser_agreement_cpl_adjustment_id);

        $dealAdvertiserAgreementCplAdjustment = $dealAdvertiserAgreementCplAdjustment->updateModel($this);

        $response = new DealAdvertiserAgreementCplAdjustmentResource($dealAdvertiserAgreementCplAdjustment);

        event(new UpdateEvent($dealAdvertiserAgreementCplAdjustment, $this->all(), $response));

        return $response;

    }

}
