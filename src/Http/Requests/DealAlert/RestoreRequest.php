<?php

namespace Innoboxrr\Deals\Http\Requests\DealAlert;

use Innoboxrr\Deals\Models\DealAlert;
use Innoboxrr\Deals\Http\Resources\Models\DealAlertResource;
use Innoboxrr\Deals\Http\Events\DealAlert\Events\RestoreEvent;
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
        
        $dealAlert = DealAlert::withTrashed()->findOrFail($this->deal_alert_id);
        
        return $this->user()->can('restore', $dealAlert);

    }

    public function rules()
    {
        return [
            'deal_alert_id' => 'required|numeric'
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

        $dealAlert = DealAlert::withTrashed()->findOrFail($this->deal_alert_id);

        $dealAlert->restoreModel();

        $response = new DealAlertResource($dealAlert);

        event(new RestoreEvent($dealAlert, $this->all(), $response));

        return $response;

    }
    
}
