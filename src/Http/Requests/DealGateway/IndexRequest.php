<?php

namespace Innoboxrr\Deals\Http\Requests\DealGateway;

use Innoboxrr\Deals\Models\DealGateway;
use Innoboxrr\Deals\Http\Resources\Models\DealGatewayResource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Innoboxrr\SearchSurge\Search\Builder;

class IndexRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        return $this->user()->can('index', DealGateway::class);
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

        $builder = new Builder();

        $query = $builder->get(DealGateway::class, $this->all());

        return DealGatewayResource::collection($query);

    }
}
