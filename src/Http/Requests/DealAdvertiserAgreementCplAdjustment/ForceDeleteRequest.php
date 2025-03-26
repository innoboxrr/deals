<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserAgreementCplAdjustment;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementCplAdjustment;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserAgreementCplAdjustmentResource;
use Innoboxrr\Deals\Http\Events\DealAdvertiserAgreementCplAdjustment\Events\ForceDeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class ForceDeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {

        $dealAdvertiserAgreementCplAdjustment = DealAdvertiserAgreementCplAdjustment::withTrashed()->findOrFail($this->deal_advertiser_agreement_cpl_adjustment_id);
        
        return $this->user()->can('forceDelete', $dealAdvertiserAgreementCplAdjustment);

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

        $dealAdvertiserAgreementCplAdjustment->forceDeleteModel();

        $response = new DealAdvertiserAgreementCplAdjustmentResource($dealAdvertiserAgreementCplAdjustment);

        event(new ForceDeleteEvent($dealAdvertiserAgreementCplAdjustment, $this->all(), $response));

        return $response;

    }
    
}
