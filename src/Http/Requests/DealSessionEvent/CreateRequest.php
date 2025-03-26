<?php

namespace Innoboxrr\Deals\Http\Requests\DealSessionEvent;

use Innoboxrr\Deals\Models\DealSessionEvent;
use Innoboxrr\Deals\Http\Resources\Models\DealSessionEventResource;
use Innoboxrr\Deals\Http\Events\DealSessionEvent\Events\CreateEvent;
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

        return $this->user()->can('create', DealSessionEvent::class);

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

        $dealSessionEvent = (new DealSessionEvent)->createModel($this);

        $response = new DealSessionEventResource($dealSessionEvent);

        event(new CreateEvent($dealSessionEvent, $this->all(), $response));

        return $response;

    }
    
}
