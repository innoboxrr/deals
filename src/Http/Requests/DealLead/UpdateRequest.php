<?php

namespace Innoboxrr\Deals\Http\Requests\DealLead;

use Innoboxrr\Deals\Models\DealLead;
use Innoboxrr\Deals\Http\Resources\Models\DealLeadResource;
use Innoboxrr\Deals\Http\Events\DealLead\Events\UpdateEvent;
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
        
        $dealLead = DealLead::findOrFail($this->deal_lead_id);

        return $this->user()->can('update', $dealLead);

    }

    public function rules()
    {
        return [
            //
            'deal_lead_id' => 'required|numeric'
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

        $dealLead = DealLead::findOrFail($this->deal_lead_id);

        $dealLead = $dealLead->updateModel($this);

        $response = new DealLeadResource($dealLead);

        event(new UpdateEvent($dealLead, $this->all(), $response));

        return $response;

    }

}
