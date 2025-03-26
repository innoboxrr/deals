<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiser;

use Innoboxrr\Deals\Models\DealAdvertiser;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserResource;
use Innoboxrr\Deals\Http\Events\DealAdvertiser\Events\RestoreEvent;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RestoreRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $dealAdvertiser = DealAdvertiser::withTrashed()->findOrFail($this->deal_advertiser_id);
        
        return $this->user()->can('restore', $dealAdvertiser);

    }

    public function rules()
    {
        return [
            'deal_advertiser_id' => 'required|numeric'
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

        $dealAdvertiser = DealAdvertiser::withTrashed()->findOrFail($this->deal_advertiser_id);

        $dealAdvertiser->restoreModel();

        $response = new DealAdvertiserResource($dealAdvertiser);

        event(new RestoreEvent($dealAdvertiser, $this->all(), $response));

        return $response;

    }
    
}
