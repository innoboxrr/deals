<?php

namespace Innoboxrr\Deals\Http\Requests\DealRouterExecution;

use Innoboxrr\Deals\Models\DealRouterExecution;
use Innoboxrr\Deals\Http\Resources\Models\DealRouterExecutionResource;
use Innoboxrr\Deals\Http\Events\DealRouterExecution\Events\DeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $dealRouterExecution = DealRouterExecution::findOrFail($this->deal_router_execution_id);

        return $this->user()->can('delete', $dealRouterExecution);

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

        $dealRouterExecution = DealRouterExecution::findOrFail($this->deal_router_execution_id);

        $dealRouterExecution->deleteModel();

        $response = new DealRouterExecutionResource($dealRouterExecution);

        event(new DeleteEvent($dealRouterExecution, $this->all(), $response));

        return $response;

    }
    
}
