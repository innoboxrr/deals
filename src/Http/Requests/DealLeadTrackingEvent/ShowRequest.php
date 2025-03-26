<?php

namespace Innoboxrr\Deals\Http\Requests\DealLeadTrackingEvent;

use Innoboxrr\Deals\Models\DealLeadTrackingEvent;
use Innoboxrr\Deals\Http\Resources\Models\DealLeadTrackingEventResource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShowRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {

        $dealLeadTrackingEvent = DealLeadTrackingEvent::findOrFail($this->deal_lead_tracking_event_id);

        return $this->user()->can('view', $dealLeadTrackingEvent);

    }

    public function rules()
    {
        return [
            'load_relations' => [
                'nullable',
                'array',
                Rule::in(DealLeadTrackingEvent::$loadable_relations)
            ],
            'load_counts' => [
                'nullable',
                'array',
                Rule::in(DealLeadTrackingEvent::$loadable_counts)
            ],
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

        $dealLeadTrackingEvent = DealLeadTrackingEvent::where('id', $this->deal_lead_tracking_event_id)
            ->with($this->load_relations ?? [])
            ->withCount($this->load_counts ?? [])
            ->firstOrFail();

        return new DealLeadTrackingEventResource($dealLeadTrackingEvent);

    }
    
}
