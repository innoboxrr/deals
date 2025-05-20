<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiser;

use Innoboxrr\Deals\Models\DealAdvertiser;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserResource;
use Innoboxrr\Deals\Http\Events\DealAdvertiser\Events\UpdateEvent;
use Illuminate\Foundation\Http\FormRequest;
use Innoboxrr\Support\Http\Requests\RequestFormater;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        RequestFormater::format($this);
    }

    public function authorize()
    {
        $dealAdvertiser = DealAdvertiser::findOrFail($this->deal_advertiser_id);
        return $this->user()->can('update', $dealAdvertiser);
    }

    public function rules()
    {
        return [
            //
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

        $dealAdvertiser = $dealAdvertiser->updateModel($this);

        $response = new DealAdvertiserResource($dealAdvertiser);

        event(new UpdateEvent($dealAdvertiser, $this->all(), $response));

        return $response;

    }

}
