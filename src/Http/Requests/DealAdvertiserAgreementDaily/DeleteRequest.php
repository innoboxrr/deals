<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserAgreementDaily;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementDaily;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserAgreementDailyResource;
use Innoboxrr\Deals\Http\Events\DealAdvertiserAgreementDaily\Events\DeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $dealAdvertiserAgreementDaily = DealAdvertiserAgreementDaily::findOrFail($this->deal_advertiser_agreement_daily_id);

        return $this->user()->can('delete', $dealAdvertiserAgreementDaily);

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

        $dealAdvertiserAgreementDaily = DealAdvertiserAgreementDaily::findOrFail($this->deal_advertiser_agreement_daily_id);

        $dealAdvertiserAgreementDaily->deleteModel();

        $response = new DealAdvertiserAgreementDailyResource($dealAdvertiserAgreementDaily);

        event(new DeleteEvent($dealAdvertiserAgreementDaily, $this->all(), $response));

        return $response;

    }
    
}
