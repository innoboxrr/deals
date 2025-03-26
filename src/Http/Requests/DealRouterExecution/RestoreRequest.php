<?php

namespace Innoboxrr\Deals\Http\Requests\DealRouterExecution;

use Innoboxrr\Deals\Models\DealRouterExecution;
use Innoboxrr\Deals\Http\Resources\Models\DealRouterExecutionResource;
use Innoboxrr\Deals\Http\Events\DealRouterExecution\Events\RestoreEvent;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RestoreRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $dealRouterExecution = DealRouterExecution::withTrashed()->findOrFail($this->deal_router_execution_id);
        
        return $this->user()->can('restore', $dealRouterExecution);

    }

    public function rules()
    {
        return [
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

        $dealRouterExecution = DealRouterExecution::withTrashed()->findOrFail($this->deal_router_execution_id);

        $dealRouterExecution->restoreModel();

        $response = new DealRouterExecutionResource($dealRouterExecution);

        event(new RestoreEvent($dealRouterExecution, $this->all(), $response));

        return $response;

    }
    
}
