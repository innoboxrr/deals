<?php

namespace Innoboxrr\Deals\Http\Requests\DealAssignment;

use Innoboxrr\Deals\Models\DealAssignment;
use Innoboxrr\Deals\Http\Resources\Models\DealAssignmentResource;
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

        $dealAssignment = DealAssignment::findOrFail($this->deal_assignment_id);

        return $this->user()->can('view', $dealAssignment);

    }

    public function rules()
    {
        return [
            'load_relations' => [
                'nullable',
                'array',
                Rule::in(DealAssignment::$loadable_relations)
            ],
            'load_counts' => [
                'nullable',
                'array',
                Rule::in(DealAssignment::$loadable_counts)
            ],
            'deal_assignment_id' => 'required|numeric'
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

        $dealAssignment = DealAssignment::where('id', $this->deal_assignment_id)
            ->with($this->load_relations ?? [])
            ->withCount($this->load_counts ?? [])
            ->firstOrFail();

        return new DealAssignmentResource($dealAssignment);

    }
    
}
