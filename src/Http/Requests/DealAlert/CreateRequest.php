<?php

namespace Innoboxrr\Deals\Http\Requests\DealAlert;

use Innoboxrr\Deals\Models\DealAlert;
use Innoboxrr\Deals\Http\Resources\Models\DealAlertResource;
use Innoboxrr\Deals\Http\Events\DealAlert\Events\CreateEvent;
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

        return $this->user()->can('create', DealAlert::class);

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

        $dealAlert = (new DealAlert)->createModel($this);

        $response = new DealAlertResource($dealAlert);

        event(new CreateEvent($dealAlert, $this->all(), $response));

        return $response;

    }
    
}
