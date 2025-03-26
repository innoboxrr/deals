<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdGroup;

use Innoboxrr\Deals\Models\DealAdGroup;
use Innoboxrr\Deals\Http\Resources\Models\DealAdGroupResource;
use Innoboxrr\Deals\Http\Events\DealAdGroup\Events\CreateEvent;
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

        return $this->user()->can('create', DealAdGroup::class);

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

        $dealAdGroup = (new DealAdGroup)->createModel($this);

        $response = new DealAdGroupResource($dealAdGroup);

        event(new CreateEvent($dealAdGroup, $this->all(), $response));

        return $response;

    }
    
}
