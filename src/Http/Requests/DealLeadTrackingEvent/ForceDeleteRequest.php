<?php

namespace Innoboxrr\Deals\Http\Requests\DealLeadTrackingEvent;

use Innoboxrr\Deals\Models\DealLeadTrackingEvent;
use Innoboxrr\Deals\Http\Resources\Models\DealLeadTrackingEventResource;
use Innoboxrr\Deals\Http\Events\DealLeadTrackingEvent\Events\ForceDeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class ForceDeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {

        $dealLeadTrackingEvent = DealLeadTrackingEvent::withTrashed()->findOrFail($this->deal_lead_tracking_event_id);
        
        return $this->user()->can('forceDelete', $dealLeadTrackingEvent);

    }

    public function rules()
    {
        return [
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

        $dealLeadTrackingEvent = DealLeadTrackingEvent::withTrashed()->findOrFail($this->deal_lead_tracking_event_id);

        $dealLeadTrackingEvent->forceDeleteModel();

        $response = new DealLeadTrackingEventResource($dealLeadTrackingEvent);

        event(new ForceDeleteEvent($dealLeadTrackingEvent, $this->all(), $response));

        return $response;

    }
    
}
