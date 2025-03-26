<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiser;

use Innoboxrr\Deals\Models\DealAdvertiser;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserResource;
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
        return $this->user()->can('index', DealAdvertiser::class);
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

        $query = $builder->get(DealAdvertiser::class, $this->all());

        return DealAdvertiserResource::collection($query);

    }
}
