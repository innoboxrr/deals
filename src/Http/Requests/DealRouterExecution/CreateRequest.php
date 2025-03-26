<?php

namespace Innoboxrr\Deals\Http\Requests\DealRouterExecution;

use Innoboxrr\Deals\Models\DealRouterExecution;
use Innoboxrr\Deals\Http\Resources\Models\DealRouterExecutionResource;
use Innoboxrr\Deals\Http\Events\DealRouterExecution\Events\CreateEvent;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {

        return $this->user()->can('create', DealRouterExecution::class);

    }

    public function rules()
    {
        return [
            //
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

        $dealRouterExecution = (new DealRouterExecution)->createModel($this);

        $response = new DealRouterExecutionResource($dealRouterExecution);

        event(new CreateEvent($dealRouterExecution, $this->all(), $response));

        return $response;

    }
    
}
