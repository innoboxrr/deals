<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserAgreementConfig;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementConfig;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserAgreementConfigResource;
use Innoboxrr\Deals\Http\Events\DealAdvertiserAgreementConfig\Events\CreateEvent;
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

        return $this->user()->can('create', DealAdvertiserAgreementConfig::class);

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

        $dealAdvertiserAgreementConfig = (new DealAdvertiserAgreementConfig)->createModel($this);

        $response = new DealAdvertiserAgreementConfigResource($dealAdvertiserAgreementConfig);

        event(new CreateEvent($dealAdvertiserAgreementConfig, $this->all(), $response));

        return $response;

    }
    
}
