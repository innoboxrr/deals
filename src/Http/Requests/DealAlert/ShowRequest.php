<?php

namespace Innoboxrr\Deals\Http\Requests\DealAlert;

use Innoboxrr\Deals\Models\DealAlert;
use Innoboxrr\Deals\Http\Resources\Models\DealAlertResource;
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

        $dealAlert = DealAlert::findOrFail($this->deal_alert_id);

        return $this->user()->can('view', $dealAlert);

    }

    public function rules()
    {
        return [
            'load_relations' => [
                'nullable',
                'array',
                Rule::in(DealAlert::$loadable_relations)
            ],
            'load_counts' => [
                'nullable',
                'array',
                Rule::in(DealAlert::$loadable_counts)
            ],
            'deal_alert_id' => 'required|numeric'
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

        $dealAlert = DealAlert::where('id', $this->deal_alert_id)
            ->with($this->load_relations ?? [])
            ->withCount($this->load_counts ?? [])
            ->firstOrFail();

        return new DealAlertResource($dealAlert);

    }
    
}
