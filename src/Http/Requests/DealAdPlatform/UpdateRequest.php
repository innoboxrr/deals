<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdPlatform;

use Innoboxrr\Deals\Models\DealAdPlatform;
use Innoboxrr\Deals\Http\Resources\Models\DealAdPlatformResource;
use Innoboxrr\Deals\Http\Events\DealAdPlatform\Events\UpdateEvent;
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
        
        $dealAdPlatform = DealAdPlatform::findOrFail($this->deal_ad_platform_id);

        return $this->user()->can('update', $dealAdPlatform);

    }

    public function rules()
    {
        return [
            //
            'deal_ad_platform_id' => 'required|numeric'
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

        $dealAdPlatform = DealAdPlatform::findOrFail($this->deal_ad_platform_id);

        $dealAdPlatform = $dealAdPlatform->updateModel($this);

        $response = new DealAdPlatformResource($dealAdPlatform);

        event(new UpdateEvent($dealAdPlatform, $this->all(), $response));

        return $response;

    }

}
