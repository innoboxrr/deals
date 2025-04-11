<?php

namespace Innoboxrr\Deals\Http\Requests\Deal;

use Innoboxrr\Deals\Models\Deal;
use Innoboxrr\Deals\Http\Resources\Models\DealResource;
use Innoboxrr\Deals\Http\Events\Deal\Events\UpdateEvent;
use Illuminate\Foundation\Http\FormRequest;
use Innoboxrr\Deals\Services\Deal\Utils\RequestFormater;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        RequestFormater::format($this);
    }

    public function authorize()
    {
        $deal = Deal::findOrFail($this->deal_id);
        return $this->user()->can('update', $deal);
    }

    public function rules()
    {
        return [
            //
            'deal_id' => 'required|numeric'
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
        $deal = Deal::findOrFail($this->deal_id);
        $deal = $deal->updateModel($this);
        $response = new DealResource($deal);
        event(new UpdateEvent($deal, $this->all(), $response));
        return $response;
    }
}