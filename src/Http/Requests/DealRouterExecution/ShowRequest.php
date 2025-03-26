<?php

namespace Innoboxrr\Deals\Http\Requests\DealRouterExecution;

use Innoboxrr\Deals\Models\DealRouterExecution;
use Innoboxrr\Deals\Http\Resources\Models\DealRouterExecutionResource;
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

        $dealRouterExecution = DealRouterExecution::findOrFail($this->deal_router_execution_id);

        return $this->user()->can('view', $dealRouterExecution);

    }

    public function rules()
    {
        return [
            'load_relations' => [
                'nullable',
                'array',
                Rule::in(DealRouterExecution::$loadable_relations)
            ],
            'load_counts' => [
                'nullable',
                'array',
                Rule::in(DealRouterExecution::$loadable_counts)
            ],
            'deal_router_execution_id' => 'required|numeric'
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

        $dealRouterExecution = DealRouterExecution::where('id', $this->deal_router_execution_id)
            ->with($this->load_relations ?? [])
            ->withCount($this->load_counts ?? [])
            ->firstOrFail();

        return new DealRouterExecutionResource($dealRouterExecution);

    }
    
}
