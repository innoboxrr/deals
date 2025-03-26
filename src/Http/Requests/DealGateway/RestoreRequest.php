<?php

namespace Innoboxrr\Deals\Http\Requests\DealGateway;

use Innoboxrr\Deals\Models\DealGateway;
use Innoboxrr\Deals\Http\Resources\Models\DealGatewayResource;
use Innoboxrr\Deals\Http\Events\DealGateway\Events\RestoreEvent;
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
        
        $dealGateway = DealGateway::withTrashed()->findOrFail($this->deal_gateway_id);
        
        return $this->user()->can('restore', $dealGateway);

    }

    public function rules()
    {
        return [
            'deal_gateway_id' => 'required|numeric'
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

        $dealGateway = DealGateway::withTrashed()->findOrFail($this->deal_gateway_id);

        $dealGateway->restoreModel();

        $response = new DealGatewayResource($dealGateway);

        event(new RestoreEvent($dealGateway, $this->all(), $response));

        return $response;

    }
    
}
