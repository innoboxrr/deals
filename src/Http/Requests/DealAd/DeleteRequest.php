<?php

namespace Innoboxrr\Deals\Http\Requests\DealAd;

use Innoboxrr\Deals\Models\DealAd;
use Innoboxrr\Deals\Http\Resources\Models\DealAdResource;
use Innoboxrr\Deals\Http\Events\DealAd\Events\DeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $dealAd = DealAd::findOrFail($this->deal_ad_id);

        return $this->user()->can('delete', $dealAd);

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

        $dealAd = DealAd::findOrFail($this->deal_ad_id);

        $dealAd->deleteModel();

        $response = new DealAdResource($dealAd);

        event(new DeleteEvent($dealAd, $this->all(), $response));

        return $response;

    }
    
}
