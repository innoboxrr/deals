<?php

namespace Innoboxrr\Deals\Http\Requests\DealGateway;

use Innoboxrr\Deals\Models\DealGateway;
use Innoboxrr\Deals\Http\Resources\Models\DealGatewayResource;
use Innoboxrr\Deals\Http\Events\DealGateway\Events\CreateEvent;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
{
    protected array $types;

    protected function prepareForValidation()
    {
        $this->types = config('app.lead_gateways');
        $this->merge([
            'gateway_type' => $this->getGateway('type'),
            'gateway_id' => $this->getGateway('id'),
        ]);
    }

    public function authorize()
    {
        return $this->user()->can('create', DealGateway::class);
    }

    public function rules()
    {
        return [
            'name' => [
                'required', 
                'string', 
                'max:255'
            ],
            'status' => [
                'required', 
            ],
            'gateway_type' => [
                'required'
            ],
            'gateway_id' => [
                'required', 
                'numeric',
            ],
            'deal_id' => [
                'required', 
                'numeric',
            ],
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
        $dealGateway = (new DealGateway)->createModel($this);
        $response = new DealGatewayResource($dealGateway);
        event(new CreateEvent($dealGateway, $this->all(), $response));
        return $response;
    }
    
    protected function getGateway($key)
    {
        $gatewayClass = $this->types[$this->input('gateway_type')] ?? null;

        if ($gatewayClass) {
            $gateway = $gatewayClass::findOrFail($this->input('gateway_id'));

            if($key === 'type') {
                return $gatewayClass;
            } elseif($key === 'id') {
                return $gateway->id;
            }
        }
    }
}
