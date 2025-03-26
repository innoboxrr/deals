<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserPaymentMethod;

use Innoboxrr\Deals\Models\DealAdvertiserPaymentMethod;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserPaymentMethodResource;
use Innoboxrr\Deals\Http\Events\DealAdvertiserPaymentMethod\Events\RestoreEvent;
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
        
        $dealAdvertiserPaymentMethod = DealAdvertiserPaymentMethod::withTrashed()->findOrFail($this->deal_advertiser_payment_method_id);
        
        return $this->user()->can('restore', $dealAdvertiserPaymentMethod);

    }

    public function rules()
    {
        return [
            'deal_advertiser_payment_method_id' => 'required|numeric'
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

        $dealAdvertiserPaymentMethod = DealAdvertiserPaymentMethod::withTrashed()->findOrFail($this->deal_advertiser_payment_method_id);

        $dealAdvertiserPaymentMethod->restoreModel();

        $response = new DealAdvertiserPaymentMethodResource($dealAdvertiserPaymentMethod);

        event(new RestoreEvent($dealAdvertiserPaymentMethod, $this->all(), $response));

        return $response;

    }
    
}
