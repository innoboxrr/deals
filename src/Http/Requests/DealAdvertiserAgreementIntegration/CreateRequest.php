<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserAgreementIntegration;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementIntegration;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserAgreementIntegrationResource;
use Innoboxrr\Deals\Http\Events\DealAdvertiserAgreementIntegration\Events\CreateEvent;
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

        return $this->user()->can('create', DealAdvertiserAgreementIntegration::class);

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

        $dealAdvertiserAgreementIntegration = (new DealAdvertiserAgreementIntegration)->createModel($this);

        $response = new DealAdvertiserAgreementIntegrationResource($dealAdvertiserAgreementIntegration);

        event(new CreateEvent($dealAdvertiserAgreementIntegration, $this->all(), $response));

        return $response;

    }
    
}
