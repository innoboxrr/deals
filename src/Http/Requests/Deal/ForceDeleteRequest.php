<?php

namespace Innoboxrr\Deals\Http\Requests\Deal;

use Innoboxrr\Deals\Models\Deal;
use Innoboxrr\Deals\Http\Resources\Models\DealResource;
use Innoboxrr\Deals\Http\Events\Deal\Events\ForceDeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class ForceDeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {

        $deal = Deal::withTrashed()->findOrFail($this->deal_id);
        
        return $this->user()->can('forceDelete', $deal);

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

        $deal->forceDeleteModel();

        $response = new DealResource($deal);

        event(new ForceDeleteEvent($deal, $this->all(), $response));

        return $response;

    }
    
}
