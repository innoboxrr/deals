<?php

namespace Innoboxrr\Deals\Http\Requests\DealAssignment;

use Innoboxrr\Deals\Models\DealAssignment;
use Innoboxrr\Deals\Http\Resources\Models\DealAssignmentResource;
use Innoboxrr\Deals\Http\Events\DealAssignment\Events\DeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $dealAssignment = DealAssignment::findOrFail($this->deal_assignment_id);

        return $this->user()->can('delete', $dealAssignment);

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

        $dealAssignment = DealAssignment::findOrFail($this->deal_assignment_id);

        $dealAssignment->deleteModel();

        $response = new DealAssignmentResource($dealAssignment);

        event(new DeleteEvent($dealAssignment, $this->all(), $response));

        return $response;

    }
    
}
