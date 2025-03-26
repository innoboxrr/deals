<?php

namespace Innoboxrr\Deals\Http\Requests\DealSessionEvent;

use Innoboxrr\Deals\Models\DealSessionEvent;
use Innoboxrr\Deals\Http\Resources\Models\DealSessionEventResource;
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

        $dealSessionEvent = DealSessionEvent::findOrFail($this->deal_session_event_id);

        return $this->user()->can('view', $dealSessionEvent);

    }

    public function rules()
    {
        return [
            'load_relations' => [
                'nullable',
                'array',
                Rule::in(DealSessionEvent::$loadable_relations)
            ],
            'load_counts' => [
                'nullable',
                'array',
                Rule::in(DealSessionEvent::$loadable_counts)
            ],
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

        $dealSessionEvent = DealSessionEvent::where('id', $this->deal_session_event_id)
            ->with($this->load_relations ?? [])
            ->withCount($this->load_counts ?? [])
            ->firstOrFail();

        return new DealSessionEventResource($dealSessionEvent);

    }
    
}
