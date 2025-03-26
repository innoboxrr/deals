<?php

namespace Innoboxrr\Deals\Http\Requests\Deal;

use Innoboxrr\Deals\Models\Deal;
use Innoboxrr\Deals\Http\Resources\Models\DealResource;
use Innoboxrr\Deals\Http\Events\Deal\Events\DeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $deal = Deal::findOrFail($this->deal_id);

        return $this->user()->can('delete', $deal);

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

        $deal = Deal::findOrFail($this->deal_id);

        $deal->deleteModel();

        $response = new DealResource($deal);

        event(new DeleteEvent($deal, $this->all(), $response));

        return $response;

    }
    
}
