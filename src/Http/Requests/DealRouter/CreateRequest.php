<?php

namespace Innoboxrr\Deals\Http\Requests\DealRouter;

use Innoboxrr\Deals\Models\DealRouter;
use Innoboxrr\Deals\Http\Resources\Models\DealRouterResource;
use Innoboxrr\Deals\Http\Events\DealRouter\Events\CreateEvent;
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

        return $this->user()->can('create', DealRouter::class);

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

        $dealRouter = (new DealRouter)->createModel($this);

        $response = new DealRouterResource($dealRouter);

        event(new CreateEvent($dealRouter, $this->all(), $response));

        return $response;

    }
    
}
