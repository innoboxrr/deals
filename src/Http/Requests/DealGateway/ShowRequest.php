<?php

namespace Innoboxrr\Deals\Http\Requests\DealGateway;

use Innoboxrr\Deals\Models\DealGateway;
use Innoboxrr\Deals\Http\Resources\Models\DealGatewayResource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShowRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {

        $dealGateway = DealGateway::findOrFail($this->deal_gateway_id);

        return $this->user()->can('view', $dealGateway);

    }

    public function rules()
    {
        return [
            'load_relations' => [
                'nullable',
                'array',
                Rule::in(DealGateway::$loadable_relations)
            ],
            'load_counts' => [
                'nullable',
                'array',
                Rule::in(DealGateway::$loadable_counts)
            ],
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

        $dealGateway = DealGateway::where('id', $this->deal_gateway_id)
            ->with($this->load_relations ?? [])
            ->withCount($this->load_counts ?? [])
            ->firstOrFail();

        return new DealGatewayResource($dealGateway);

    }
    
}
