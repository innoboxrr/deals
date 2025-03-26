<?php

namespace Innoboxrr\Deals\Http\Requests\DealGateway;

use Innoboxrr\Deals\Models\DealGateway;
use Innoboxrr\Deals\Http\Resources\Models\DealGatewayResource;
use Innoboxrr\Deals\Http\Events\DealGateway\Events\DeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $dealGateway = DealGateway::findOrFail($this->deal_gateway_id);

        return $this->user()->can('delete', $dealGateway);

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

        $dealGateway = DealGateway::findOrFail($this->deal_gateway_id);

        $dealGateway->deleteModel();

        $response = new DealGatewayResource($dealGateway);

        event(new DeleteEvent($dealGateway, $this->all(), $response));

        return $response;

    }
    
}
