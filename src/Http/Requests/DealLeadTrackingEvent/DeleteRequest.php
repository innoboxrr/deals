<?php

namespace Innoboxrr\Deals\Http\Requests\DealLeadTrackingEvent;

use Innoboxrr\Deals\Models\DealLeadTrackingEvent;
use Innoboxrr\Deals\Http\Resources\Models\DealLeadTrackingEventResource;
use Innoboxrr\Deals\Http\Events\DealLeadTrackingEvent\Events\DeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $dealLeadTrackingEvent = DealLeadTrackingEvent::findOrFail($this->deal_lead_tracking_event_id);

        return $this->user()->can('delete', $dealLeadTrackingEvent);

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

        $dealLeadTrackingEvent = DealLeadTrackingEvent::findOrFail($this->deal_lead_tracking_event_id);

        $dealLeadTrackingEvent->deleteModel();

        $response = new DealLeadTrackingEventResource($dealLeadTrackingEvent);

        event(new DeleteEvent($dealLeadTrackingEvent, $this->all(), $response));

        return $response;

    }
    
}
