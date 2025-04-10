<?php

namespace Innoboxrr\Deals\Http\Requests\DealSessionEvent;

use Innoboxrr\Deals\Models\DealSessionEvent;
use Innoboxrr\Deals\Http\Resources\Models\DealSessionEventResource;
use Innoboxrr\Deals\Http\Events\DealSessionEvent\Events\ForceDeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class ForceDeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {

        $dealSessionEvent = DealSessionEvent::withTrashed()->findOrFail($this->deal_session_event_id);
        
        return $this->user()->can('forceDelete', $dealSessionEvent);

    }

    public function rules()
    {
        return [
            'deal_session_event_id' => 'required|numeric'
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

        $dealSessionEvent = DealSessionEvent::withTrashed()->findOrFail($this->deal_session_event_id);

        $dealSessionEvent->forceDeleteModel();

        $response = new DealSessionEventResource($dealSessionEvent);

        event(new ForceDeleteEvent($dealSessionEvent, $this->all(), $response));

        return $response;

    }
    
}
