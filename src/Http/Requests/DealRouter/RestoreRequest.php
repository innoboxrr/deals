<?php

namespace Innoboxrr\Deals\Http\Requests\DealRouter;

use Innoboxrr\Deals\Models\DealRouter;
use Innoboxrr\Deals\Http\Resources\Models\DealRouterResource;
use Innoboxrr\Deals\Http\Events\DealRouter\Events\RestoreEvent;
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
        
        $dealRouter = DealRouter::withTrashed()->findOrFail($this->deal_router_id);
        
        return $this->user()->can('restore', $dealRouter);

    }

    public function rules()
    {
        return [
            'deal_router_id' => 'required|numeric'
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

        $dealRouter = DealRouter::withTrashed()->findOrFail($this->deal_router_id);

        $dealRouter->restoreModel();

        $response = new DealRouterResource($dealRouter);

        event(new RestoreEvent($dealRouter, $this->all(), $response));

        return $response;

    }
    
}
