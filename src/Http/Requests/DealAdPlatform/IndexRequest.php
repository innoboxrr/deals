<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdPlatform;

use Innoboxrr\Deals\Models\DealAdPlatform;
use Innoboxrr\Deals\Http\Resources\Models\DealAdPlatformResource;
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
        return $this->user()->can('index', DealAdPlatform::class);
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

        $query = $builder->get(DealAdPlatform::class, $this->all());

        return DealAdPlatformResource::collection($query);

    }
}
