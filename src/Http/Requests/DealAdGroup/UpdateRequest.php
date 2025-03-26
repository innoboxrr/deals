<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdGroup;

use Innoboxrr\Deals\Models\DealAdGroup;
use Innoboxrr\Deals\Http\Resources\Models\DealAdGroupResource;
use Innoboxrr\Deals\Http\Events\DealAdGroup\Events\UpdateEvent;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $dealAdGroup = DealAdGroup::findOrFail($this->deal_ad_group_id);

        return $this->user()->can('update', $dealAdGroup);

    }

    public function rules()
    {
        return [
            //
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

        $dealAdGroup = $dealAdGroup->updateModel($this);

        $response = new DealAdGroupResource($dealAdGroup);

        event(new UpdateEvent($dealAdGroup, $this->all(), $response));

        return $response;

    }

}
