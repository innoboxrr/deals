<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdPlatform;

use Innoboxrr\Deals\Models\DealAdPlatform;
use Innoboxrr\Deals\Http\Resources\Models\DealAdPlatformResource;
use Innoboxrr\Deals\Http\Events\DealAdPlatform\Events\DeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $dealAdPlatform = DealAdPlatform::findOrFail($this->deal_ad_platform_id);

        return $this->user()->can('delete', $dealAdPlatform);

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

        $dealAdPlatform = DealAdPlatform::findOrFail($this->deal_ad_platform_id);

        $dealAdPlatform->deleteModel();

        $response = new DealAdPlatformResource($dealAdPlatform);

        event(new DeleteEvent($dealAdPlatform, $this->all(), $response));

        return $response;

    }
    
}
