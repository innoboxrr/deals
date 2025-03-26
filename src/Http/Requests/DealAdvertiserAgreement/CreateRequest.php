<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserAgreement;

use Innoboxrr\Deals\Models\DealAdvertiserAgreement;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserAgreementResource;
use Innoboxrr\Deals\Http\Events\DealAdvertiserAgreement\Events\CreateEvent;
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

        return $this->user()->can('create', DealAdvertiserAgreement::class);

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

        $dealAdvertiserAgreement = (new DealAdvertiserAgreement)->createModel($this);

        $response = new DealAdvertiserAgreementResource($dealAdvertiserAgreement);

        event(new CreateEvent($dealAdvertiserAgreement, $this->all(), $response));

        return $response;

    }
    
}
