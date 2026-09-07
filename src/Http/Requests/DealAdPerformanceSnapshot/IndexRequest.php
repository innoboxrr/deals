<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdPerformanceSnapshot;

use Innoboxrr\Deals\Models\DealAdPerformanceSnapshot;
use Innoboxrr\Deals\Http\Resources\Models\DealAdPerformanceSnapshotResource;
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
        return $this->user()->can('index', DealAdPerformanceSnapshot::class);
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

        $query = $builder->get(DealAdPerformanceSnapshot::class, $this->all(), config('deals.search-options'));

        return DealAdPerformanceSnapshotResource::collection($query);

    }
}
