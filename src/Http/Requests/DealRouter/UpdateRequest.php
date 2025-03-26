<?php

namespace Innoboxrr\Deals\Http\Requests\DealRouter;

use Innoboxrr\Deals\Models\DealRouter;
use Innoboxrr\Deals\Http\Resources\Models\DealRouterResource;
use Innoboxrr\Deals\Http\Events\DealRouter\Events\UpdateEvent;
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
        
        $dealRouter = DealRouter::findOrFail($this->deal_router_id);

        return $this->user()->can('update', $dealRouter);

    }

    public function rules()
    {
        return [
            //
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

        $dealRouter = DealRouter::findOrFail($this->deal_router_id);

        $dealRouter = $dealRouter->updateModel($this);

        $response = new DealRouterResource($dealRouter);

        event(new UpdateEvent($dealRouter, $this->all(), $response));

        return $response;

    }

}
