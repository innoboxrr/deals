<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserAgreementDaily;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementDaily;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserAgreementDailyResource;
use Innoboxrr\Deals\Http\Events\DealAdvertiserAgreementDaily\Events\RestoreEvent;
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
        
        $dealAdvertiserAgreementDaily = DealAdvertiserAgreementDaily::withTrashed()->findOrFail($this->deal_advertiser_agreement_daily_id);
        
        return $this->user()->can('restore', $dealAdvertiserAgreementDaily);

    }

    public function rules()
    {
        return [
            'deal_advertiser_agreement_daily_id' => 'required|numeric'
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

        $dealAdvertiserAgreementDaily = DealAdvertiserAgreementDaily::withTrashed()->findOrFail($this->deal_advertiser_agreement_daily_id);

        $dealAdvertiserAgreementDaily->restoreModel();

        $response = new DealAdvertiserAgreementDailyResource($dealAdvertiserAgreementDaily);

        event(new RestoreEvent($dealAdvertiserAgreementDaily, $this->all(), $response));

        return $response;

    }
    
}
