<?php

namespace Innoboxrr\Deals\Http\Requests\DealRouterExecution;

use Innoboxrr\Deals\Models\DealRouterExecution;
use Innoboxrr\Deals\Http\Resources\Models\DealRouterExecutionResource;
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
        return $this->user()->can('index', DealRouterExecution::class);
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

        $query = $builder->get(DealRouterExecution::class, $this->all(), config('deals.search-options'));

        return DealRouterExecutionResource::collection($query);

    }
}
