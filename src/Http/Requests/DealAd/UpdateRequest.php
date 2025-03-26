<?php

namespace Innoboxrr\Deals\Http\Requests\DealAd;

use Innoboxrr\Deals\Models\DealAd;
use Innoboxrr\Deals\Http\Resources\Models\DealAdResource;
use Innoboxrr\Deals\Http\Events\DealAd\Events\UpdateEvent;
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
        
        $dealAd = DealAd::findOrFail($this->deal_ad_id);

        return $this->user()->can('update', $dealAd);

    }

    public function rules()
    {
        return [
            //
            'deal_ad_id' => 'required|numeric'
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

        $dealAd = DealAd::findOrFail($this->deal_ad_id);

        $dealAd = $dealAd->updateModel($this);

        $response = new DealAdResource($dealAd);

        event(new UpdateEvent($dealAd, $this->all(), $response));

        return $response;

    }

}
