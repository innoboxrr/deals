<?php

namespace Innoboxrr\Deals\Http\Requests\DealLeadTrackingEvent;

use Innoboxrr\Deals\Models\DealLeadTrackingEvent;
use Innoboxrr\Deals\Http\Resources\Models\DealLeadTrackingEventResource;
use Innoboxrr\Deals\Http\Events\DealLeadTrackingEvent\Events\CreateEvent;
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

        return $this->user()->can('create', DealLeadTrackingEvent::class);

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

        $dealLeadTrackingEvent = (new DealLeadTrackingEvent)->createModel($this);

        $response = new DealLeadTrackingEventResource($dealLeadTrackingEvent);

        event(new CreateEvent($dealLeadTrackingEvent, $this->all(), $response));

        return $response;

    }
    
}
