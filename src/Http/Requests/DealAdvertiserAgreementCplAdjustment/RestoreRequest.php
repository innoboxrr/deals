<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserAgreementCplAdjustment;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementCplAdjustment;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserAgreementCplAdjustmentResource;
use Innoboxrr\Deals\Http\Events\DealAdvertiserAgreementCplAdjustment\Events\RestoreEvent;
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
        
        $dealAdvertiserAgreementCplAdjustment = DealAdvertiserAgreementCplAdjustment::withTrashed()->findOrFail($this->deal_advertiser_agreement_cpl_adjustment_id);
        
        return $this->user()->can('restore', $dealAdvertiserAgreementCplAdjustment);

    }

    public function rules()
    {
        return [
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

        $dealAdvertiserAgreementCplAdjustment = DealAdvertiserAgreementCplAdjustment::withTrashed()->findOrFail($this->deal_advertiser_agreement_cpl_adjustment_id);

        $dealAdvertiserAgreementCplAdjustment->restoreModel();

        $response = new DealAdvertiserAgreementCplAdjustmentResource($dealAdvertiserAgreementCplAdjustment);

        event(new RestoreEvent($dealAdvertiserAgreementCplAdjustment, $this->all(), $response));

        return $response;

    }
    
}
