<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserAgreementCplAdjustment;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementCplAdjustment;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserAgreementCplAdjustmentResource;
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
        return $this->user()->can('index', DealAdvertiserAgreementCplAdjustment::class);
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

        $query = $builder->get(DealAdvertiserAgreementCplAdjustment::class, $this->all());

        return DealAdvertiserAgreementCplAdjustmentResource::collection($query);

    }
}
