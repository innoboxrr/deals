<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserPaymentMethod;

use Innoboxrr\Deals\Models\DealAdvertiserPaymentMethod;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserPaymentMethodResource;
use Innoboxrr\Deals\Http\Events\DealAdvertiserPaymentMethod\Events\DeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $dealAdvertiserPaymentMethod = DealAdvertiserPaymentMethod::findOrFail($this->deal_advertiser_payment_method_id);

        return $this->user()->can('delete', $dealAdvertiserPaymentMethod);

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

        $dealAdvertiserPaymentMethod = DealAdvertiserPaymentMethod::findOrFail($this->deal_advertiser_payment_method_id);

        $dealAdvertiserPaymentMethod->deleteModel();

        $response = new DealAdvertiserPaymentMethodResource($dealAdvertiserPaymentMethod);

        event(new DeleteEvent($dealAdvertiserPaymentMethod, $this->all(), $response));

        return $response;

    }
    
}
