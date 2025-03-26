<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserAgreementCplAdjustment;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementCplAdjustment;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserAgreementCplAdjustmentResource;
use Innoboxrr\Deals\Http\Events\DealAdvertiserAgreementCplAdjustment\Events\CreateEvent;
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

        return $this->user()->can('create', DealAdvertiserAgreementCplAdjustment::class);

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

        $dealAdvertiserAgreementCplAdjustment = (new DealAdvertiserAgreementCplAdjustment)->createModel($this);

        $response = new DealAdvertiserAgreementCplAdjustmentResource($dealAdvertiserAgreementCplAdjustment);

        event(new CreateEvent($dealAdvertiserAgreementCplAdjustment, $this->all(), $response));

        return $response;

    }
    
}
