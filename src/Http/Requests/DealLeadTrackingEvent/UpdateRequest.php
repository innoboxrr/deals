<?php

namespace Innoboxrr\Deals\Http\Requests\DealLeadTrackingEvent;

use Innoboxrr\Deals\Models\DealLeadTrackingEvent;
use Innoboxrr\Deals\Http\Resources\Models\DealLeadTrackingEventResource;
use Innoboxrr\Deals\Http\Events\DealLeadTrackingEvent\Events\UpdateEvent;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $dealLeadTrackingEvent = DealLeadTrackingEvent::findOrFail($this->deal_lead_tracking_event_id);

        return $this->user()->can('update', $dealLeadTrackingEvent);

    }

    public function rules()
    {
        return [
            //
            'deal_lead_tracking_event_id' => 'required|numeric'
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

        $dealLeadTrackingEvent = DealLeadTrackingEvent::findOrFail($this->deal_lead_tracking_event_id);

        $dealLeadTrackingEvent = $dealLeadTrackingEvent->updateModel($this);

        $response = new DealLeadTrackingEventResource($dealLeadTrackingEvent);

        event(new UpdateEvent($dealLeadTrackingEvent, $this->all(), $response));

        return $response;

    }

}
