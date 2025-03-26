<?php

namespace Innoboxrr\Deals\Http\Requests\DealSession;

use Innoboxrr\Deals\Models\DealSession;
use Innoboxrr\Deals\Http\Resources\Models\DealSessionResource;
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
        return $this->user()->can('index', DealSession::class);
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

        $query = $builder->get(DealSession::class, $this->all());

        return DealSessionResource::collection($query);

    }
}
