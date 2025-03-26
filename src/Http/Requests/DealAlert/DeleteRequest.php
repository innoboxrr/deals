<?php

namespace Innoboxrr\Deals\Http\Requests\DealAlert;

use Innoboxrr\Deals\Models\DealAlert;
use Innoboxrr\Deals\Http\Resources\Models\DealAlertResource;
use Innoboxrr\Deals\Http\Events\DealAlert\Events\DeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $dealAlert = DealAlert::findOrFail($this->deal_alert_id);

        return $this->user()->can('delete', $dealAlert);

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

        $dealAlert = DealAlert::findOrFail($this->deal_alert_id);

        $dealAlert->deleteModel();

        $response = new DealAlertResource($dealAlert);

        event(new DeleteEvent($dealAlert, $this->all(), $response));

        return $response;

    }
    
}
