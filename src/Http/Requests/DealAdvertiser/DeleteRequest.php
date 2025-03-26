<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiser;

use Innoboxrr\Deals\Models\DealAdvertiser;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserResource;
use Innoboxrr\Deals\Http\Events\DealAdvertiser\Events\DeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $dealAdvertiser = DealAdvertiser::findOrFail($this->deal_advertiser_id);

        return $this->user()->can('delete', $dealAdvertiser);

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

        $dealAdvertiser = DealAdvertiser::findOrFail($this->deal_advertiser_id);

        $dealAdvertiser->deleteModel();

        $response = new DealAdvertiserResource($dealAdvertiser);

        event(new DeleteEvent($dealAdvertiser, $this->all(), $response));

        return $response;

    }
    
}
