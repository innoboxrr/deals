<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdPlatform;

use Innoboxrr\Deals\Models\DealAdPlatform;
use Innoboxrr\Deals\Http\Resources\Models\DealAdPlatformResource;
use Innoboxrr\Deals\Http\Events\DealAdPlatform\Events\ForceDeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class ForceDeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {

        $dealAdPlatform = DealAdPlatform::withTrashed()->findOrFail($this->deal_ad_platform_id);
        
        return $this->user()->can('forceDelete', $dealAdPlatform);

    }

    public function rules()
    {
        return [
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

        $dealAdPlatform = DealAdPlatform::withTrashed()->findOrFail($this->deal_ad_platform_id);

        $dealAdPlatform->forceDeleteModel();

        $response = new DealAdPlatformResource($dealAdPlatform);

        event(new ForceDeleteEvent($dealAdPlatform, $this->all(), $response));

        return $response;

    }
    
}
