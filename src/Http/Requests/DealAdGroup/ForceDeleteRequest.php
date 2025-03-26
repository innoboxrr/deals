<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdGroup;

use Innoboxrr\Deals\Models\DealAdGroup;
use Innoboxrr\Deals\Http\Resources\Models\DealAdGroupResource;
use Innoboxrr\Deals\Http\Events\DealAdGroup\Events\ForceDeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class ForceDeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {

        $dealAdGroup = DealAdGroup::withTrashed()->findOrFail($this->deal_ad_group_id);
        
        return $this->user()->can('forceDelete', $dealAdGroup);

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

        $dealAdGroup = DealAdGroup::withTrashed()->findOrFail($this->deal_ad_group_id);

        $dealAdGroup->forceDeleteModel();

        $response = new DealAdGroupResource($dealAdGroup);

        event(new ForceDeleteEvent($dealAdGroup, $this->all(), $response));

        return $response;

    }
    
}
