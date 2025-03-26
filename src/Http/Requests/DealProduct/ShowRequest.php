<?php

namespace Innoboxrr\Deals\Http\Requests\DealProduct;

use Innoboxrr\Deals\Models\DealProduct;
use Innoboxrr\Deals\Http\Resources\Models\DealProductResource;
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

        $dealProduct = DealProduct::findOrFail($this->deal_product_id);

        return $this->user()->can('view', $dealProduct);

    }

    public function rules()
    {
        return [
            'load_relations' => [
                'nullable',
                'array',
                Rule::in(DealProduct::$loadable_relations)
            ],
            'load_counts' => [
                'nullable',
                'array',
                Rule::in(DealProduct::$loadable_counts)
            ],
            'deal_product_id' => 'required|numeric'
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

        $dealProduct = DealProduct::where('id', $this->deal_product_id)
            ->with($this->load_relations ?? [])
            ->withCount($this->load_counts ?? [])
            ->firstOrFail();

        return new DealProductResource($dealProduct);

    }
    
}
