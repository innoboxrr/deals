<?php

namespace Innoboxrr\Deals\Http\Requests\DealSession;

use Innoboxrr\Deals\Models\DealSession;
use Innoboxrr\Deals\Http\Resources\Models\DealSessionResource;
use Innoboxrr\Deals\Http\Events\DealSession\Events\RestoreEvent;
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
        
        $dealSession = DealSession::withTrashed()->findOrFail($this->deal_session_id);
        
        return $this->user()->can('restore', $dealSession);

    }

    public function rules()
    {
        return [
            'deal_session_id' => 'required|numeric'
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

        $dealSession = DealSession::withTrashed()->findOrFail($this->deal_session_id);

        $dealSession->restoreModel();

        $response = new DealSessionResource($dealSession);

        event(new RestoreEvent($dealSession, $this->all(), $response));

        return $response;

    }
    
}
