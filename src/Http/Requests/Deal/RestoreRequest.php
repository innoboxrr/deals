<?php

namespace Innoboxrr\Deals\Http\Requests\Deal;

use Innoboxrr\Deals\Models\Deal;
use Innoboxrr\Deals\Http\Resources\Models\DealResource;
use Innoboxrr\Deals\Http\Events\Deal\Events\RestoreEvent;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RestoreRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $deal = Deal::withTrashed()->findOrFail($this->deal_id);
        
        return $this->user()->can('restore', $deal);

    }

    public function rules()
    {
        return [
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

        $deal = Deal::withTrashed()->findOrFail($this->deal_id);

        $deal->restoreModel();

        $response = new DealResource($deal);

        event(new RestoreEvent($deal, $this->all(), $response));

        return $response;

    }
    
}
