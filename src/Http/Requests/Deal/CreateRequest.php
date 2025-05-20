<?php

namespace Innoboxrr\Deals\Http\Requests\Deal;

use Innoboxrr\Deals\Models\Deal;
use Innoboxrr\Deals\Http\Resources\Models\DealResource;
use Innoboxrr\Deals\Http\Events\Deal\Events\CreateEvent;
use Illuminate\Foundation\Http\FormRequest;
use Innoboxrr\Support\Http\Requests\RequestFormater;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        RequestFormater::format($this);
    }

    public function authorize()
    {
        return $this->user()->can('create', Deal::class);
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
        $deal = (new Deal)->createModel($this);
        $response = new DealResource($deal);
        event(new CreateEvent($deal, $this->all(), $response));
        return $response;
    }   
}