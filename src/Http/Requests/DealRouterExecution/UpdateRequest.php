<?php

namespace Innoboxrr\Deals\Http\Requests\DealRouterExecution;

use Innoboxrr\Deals\Models\DealRouterExecution;
use Innoboxrr\Deals\Http\Resources\Models\DealRouterExecutionResource;
use Innoboxrr\Deals\Http\Events\DealRouterExecution\Events\UpdateEvent;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $dealRouterExecution = DealRouterExecution::findOrFail($this->deal_router_execution_id);

        return $this->user()->can('update', $dealRouterExecution);

    }

    public function rules()
    {
        return [
            //
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

        $dealRouterExecution = DealRouterExecution::findOrFail($this->deal_router_execution_id);

        $dealRouterExecution = $dealRouterExecution->updateModel($this);

        $response = new DealRouterExecutionResource($dealRouterExecution);

        event(new UpdateEvent($dealRouterExecution, $this->all(), $response));

        return $response;

    }

}
