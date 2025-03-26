<?php

namespace Innoboxrr\Deals\Http\Requests\DealLead;

use Innoboxrr\Deals\Models\DealLead;
use Innoboxrr\Deals\Http\Resources\Models\DealLeadResource;
use Innoboxrr\Deals\Http\Events\DealLead\Events\CreateEvent;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {

        return $this->user()->can('create', DealLead::class);

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

        $dealLead = (new DealLead)->createModel($this);

        $response = new DealLeadResource($dealLead);

        event(new CreateEvent($dealLead, $this->all(), $response));

        return $response;

    }
    
}
