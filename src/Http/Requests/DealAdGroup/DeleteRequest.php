<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdGroup;

use Innoboxrr\Deals\Models\DealAdGroup;
use Innoboxrr\Deals\Http\Resources\Models\DealAdGroupResource;
use Innoboxrr\Deals\Http\Events\DealAdGroup\Events\DeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $dealAdGroup = DealAdGroup::findOrFail($this->deal_ad_group_id);

        return $this->user()->can('delete', $dealAdGroup);

    }

    public function rules()
    {
        return [
            'deal_ad_group_id' => 'required|numeric'
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

        $dealAdGroup = DealAdGroup::findOrFail($this->deal_ad_group_id);

        $dealAdGroup->deleteModel();

        $response = new DealAdGroupResource($dealAdGroup);

        event(new DeleteEvent($dealAdGroup, $this->all(), $response));

        return $response;

    }
    
}
