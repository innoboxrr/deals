<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserAgreementConstraint;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementConstraint;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserAgreementConstraintResource;
use Innoboxrr\Deals\Http\Events\DealAdvertiserAgreementConstraint\Events\CreateEvent;
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

        return $this->user()->can('create', DealAdvertiserAgreementConstraint::class);

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

        $dealAdvertiserAgreementConstraint = (new DealAdvertiserAgreementConstraint)->createModel($this);

        $response = new DealAdvertiserAgreementConstraintResource($dealAdvertiserAgreementConstraint);

        event(new CreateEvent($dealAdvertiserAgreementConstraint, $this->all(), $response));

        return $response;

    }
    
}
