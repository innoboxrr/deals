<?php

namespace Innoboxrr\Deals\Http\Requests\DealAssignment;

use Innoboxrr\Deals\Models\DealAssignment;
use Innoboxrr\Deals\Http\Resources\Models\DealAssignmentResource;
use Innoboxrr\Deals\Http\Events\DealAssignment\Events\ForceDeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class ForceDeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {

        $dealAssignment = DealAssignment::withTrashed()->findOrFail($this->deal_assignment_id);
        
        return $this->user()->can('forceDelete', $dealAssignment);

    }

    public function rules()
    {
        return [
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

        $dealAssignment = DealAssignment::withTrashed()->findOrFail($this->deal_assignment_id);

        $dealAssignment->forceDeleteModel();

        $response = new DealAssignmentResource($dealAssignment);

        event(new ForceDeleteEvent($dealAssignment, $this->all(), $response));

        return $response;

    }
    
}
