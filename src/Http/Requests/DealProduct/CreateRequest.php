<?php

namespace Innoboxrr\Deals\Http\Requests\DealProduct;

use Innoboxrr\Deals\Models\DealProduct;
use Innoboxrr\Deals\Http\Resources\Models\DealProductResource;
use Innoboxrr\Deals\Http\Events\DealProduct\Events\CreateEvent;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {

        return $this->user()->can('create', DealProduct::class);

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

        $dealProduct = (new DealProduct)->createModel($this);

        $response = new DealProductResource($dealProduct);

        event(new CreateEvent($dealProduct, $this->all(), $response));

        return $response;

    }
    
}
