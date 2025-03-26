<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserAgreementDaily;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementDaily;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserAgreementDailyResource;
use Innoboxrr\Deals\Http\Events\DealAdvertiserAgreementDaily\Events\CreateEvent;
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

        return $this->user()->can('create', DealAdvertiserAgreementDaily::class);

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

        $dealAdvertiserAgreementDaily = (new DealAdvertiserAgreementDaily)->createModel($this);

        $response = new DealAdvertiserAgreementDailyResource($dealAdvertiserAgreementDaily);

        event(new CreateEvent($dealAdvertiserAgreementDaily, $this->all(), $response));

        return $response;

    }
    
}
