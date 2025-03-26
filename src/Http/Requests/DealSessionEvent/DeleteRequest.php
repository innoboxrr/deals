<?php

namespace Innoboxrr\Deals\Http\Requests\DealSessionEvent;

use Innoboxrr\Deals\Models\DealSessionEvent;
use Innoboxrr\Deals\Http\Resources\Models\DealSessionEventResource;
use Innoboxrr\Deals\Http\Events\DealSessionEvent\Events\DeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $dealSessionEvent = DealSessionEvent::findOrFail($this->deal_session_event_id);

        return $this->user()->can('delete', $dealSessionEvent);

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

        $dealSessionEvent = DealSessionEvent::findOrFail($this->deal_session_event_id);

        $dealSessionEvent->deleteModel();

        $response = new DealSessionEventResource($dealSessionEvent);

        event(new DeleteEvent($dealSessionEvent, $this->all(), $response));

        return $response;

    }
    
}
