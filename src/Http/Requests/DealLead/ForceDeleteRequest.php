<?php

namespace Innoboxrr\Deals\Http\Requests\DealLead;

use Innoboxrr\Deals\Models\DealLead;
use Innoboxrr\Deals\Http\Resources\Models\DealLeadResource;
use Innoboxrr\Deals\Http\Events\DealLead\Events\ForceDeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class ForceDeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {

        $dealLead = DealLead::withTrashed()->findOrFail($this->deal_lead_id);
        
        return $this->user()->can('forceDelete', $dealLead);

    }

    public function rules()
    {
        return [
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

        $dealLead = DealLead::withTrashed()->findOrFail($this->deal_lead_id);

        $dealLead->forceDeleteModel();

        $response = new DealLeadResource($dealLead);

        event(new ForceDeleteEvent($dealLead, $this->all(), $response));

        return $response;

    }
    
}
