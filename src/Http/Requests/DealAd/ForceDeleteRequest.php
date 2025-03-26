<?php

namespace Innoboxrr\Deals\Http\Requests\DealAd;

use Innoboxrr\Deals\Models\DealAd;
use Innoboxrr\Deals\Http\Resources\Models\DealAdResource;
use Innoboxrr\Deals\Http\Events\DealAd\Events\ForceDeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class ForceDeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {

        $dealAd = DealAd::withTrashed()->findOrFail($this->deal_ad_id);
        
        return $this->user()->can('forceDelete', $dealAd);

    }

    public function rules()
    {
        return [
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

        $dealAd = DealAd::withTrashed()->findOrFail($this->deal_ad_id);

        $dealAd->forceDeleteModel();

        $response = new DealAdResource($dealAd);

        event(new ForceDeleteEvent($dealAd, $this->all(), $response));

        return $response;

    }
    
}
