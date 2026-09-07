<?php

namespace Innoboxrr\Deals\Http\Requests\DealLead;

use Innoboxrr\Deals\Models\DealLead;
use Innoboxrr\Deals\Http\Resources\Models\DealLeadResource;
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
        return $this->user()->can('index', DealLead::class);
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

        $query = $builder->get(DealLead::class, $this->all(), config('deals.search-options'));

        return DealLeadResource::collection($query);

    }
}
