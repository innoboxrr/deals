<?php

namespace Innoboxrr\Deals\Http\Requests\DealAssignment;

use Innoboxrr\Deals\Models\DealAssignment;
use Innoboxrr\Deals\Http\Resources\Models\DealAssignmentResource;
use Innoboxrr\Deals\Http\Events\DealAssignment\Events\UpdateEvent;
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
        
        $dealAssignment = DealAssignment::findOrFail($this->deal_assignment_id);

        return $this->user()->can('update', $dealAssignment);

    }

    public function rules()
    {
        return [
            //
            'deal_assignment_id' => 'required|numeric'
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

        $dealAssignment = DealAssignment::findOrFail($this->deal_assignment_id);

        $dealAssignment = $dealAssignment->updateModel($this);

        $response = new DealAssignmentResource($dealAssignment);

        event(new UpdateEvent($dealAssignment, $this->all(), $response));

        return $response;

    }

}
