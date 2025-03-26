<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserPaymentMethod;

use Innoboxrr\Deals\Models\DealAdvertiserPaymentMethod;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserPaymentMethodResource;
use Innoboxrr\Deals\Http\Events\DealAdvertiserPaymentMethod\Events\CreateEvent;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {

        return $this->user()->can('create', DealAdvertiserPaymentMethod::class);

    }

    public function rules()
    {
        return [
            //
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

        $dealAdvertiserPaymentMethod = (new DealAdvertiserPaymentMethod)->createModel($this);

        $response = new DealAdvertiserPaymentMethodResource($dealAdvertiserPaymentMethod);

        event(new CreateEvent($dealAdvertiserPaymentMethod, $this->all(), $response));

        return $response;

    }
    
}
