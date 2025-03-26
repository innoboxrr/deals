<?php

namespace Innoboxrr\Deals\Http\Requests\DealProduct;

use Innoboxrr\Deals\Models\DealProduct;
use Innoboxrr\Deals\Http\Resources\Models\DealProductResource;
use Innoboxrr\Deals\Http\Events\DealProduct\Events\ForceDeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class ForceDeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {

        $dealProduct = DealProduct::withTrashed()->findOrFail($this->deal_product_id);
        
        return $this->user()->can('forceDelete', $dealProduct);

    }

    public function rules()
    {
        return [
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

        $dealProduct = DealProduct::withTrashed()->findOrFail($this->deal_product_id);

        $dealProduct->forceDeleteModel();

        $response = new DealProductResource($dealProduct);

        event(new ForceDeleteEvent($dealProduct, $this->all(), $response));

        return $response;

    }
    
}
