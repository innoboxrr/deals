<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiser;

use Innoboxrr\Deals\Models\DealAdvertiser;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserResource;
use Innoboxrr\Deals\Http\Events\DealAdvertiser\Events\CreateEvent;
use Illuminate\Foundation\Http\FormRequest;
use Innoboxrr\Support\Http\Requests\RequestFormater;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        RequestFormater::format($this);
    }

    public function authorize()
    {
        return $this->user()->can('create', DealAdvertiser::class);
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
        $dealAdvertiser = (new DealAdvertiser)->createModel($this);
        $response = new DealAdvertiserResource($dealAdvertiser);
        event(new CreateEvent($dealAdvertiser, $this->all(), $response));
        return $response;
    }
    
}
