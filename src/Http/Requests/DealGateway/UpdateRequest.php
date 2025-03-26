<?php

namespace Innoboxrr\Deals\Http\Requests\DealGateway;

use Innoboxrr\Deals\Models\DealGateway;
use Innoboxrr\Deals\Http\Resources\Models\DealGatewayResource;
use Innoboxrr\Deals\Http\Events\DealGateway\Events\UpdateEvent;
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
        
        $dealGateway = DealGateway::findOrFail($this->deal_gateway_id);

        return $this->user()->can('update', $dealGateway);

    }

    public function rules()
    {
        return [
            //
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

        $dealGateway = DealGateway::findOrFail($this->deal_gateway_id);

        $dealGateway = $dealGateway->updateModel($this);

        $response = new DealGatewayResource($dealGateway);

        event(new UpdateEvent($dealGateway, $this->all(), $response));

        return $response;

    }

}
