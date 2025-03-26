<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdPlatform;

use Innoboxrr\Deals\Models\DealAdPlatform;
use Innoboxrr\Deals\Http\Resources\Models\DealAdPlatformResource;
use Innoboxrr\Deals\Http\Events\DealAdPlatform\Events\CreateEvent;
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

        return $this->user()->can('create', DealAdPlatform::class);

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

        $dealAdPlatform = (new DealAdPlatform)->createModel($this);

        $response = new DealAdPlatformResource($dealAdPlatform);

        event(new CreateEvent($dealAdPlatform, $this->all(), $response));

        return $response;

    }
    
}
