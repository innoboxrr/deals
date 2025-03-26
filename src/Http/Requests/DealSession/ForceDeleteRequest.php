<?php

namespace Innoboxrr\Deals\Http\Requests\DealSession;

use Innoboxrr\Deals\Models\DealSession;
use Innoboxrr\Deals\Http\Resources\Models\DealSessionResource;
use Innoboxrr\Deals\Http\Events\DealSession\Events\ForceDeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class ForceDeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {

        $dealSession = DealSession::withTrashed()->findOrFail($this->deal_session_id);
        
        return $this->user()->can('forceDelete', $dealSession);

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

        $dealSession->forceDeleteModel();

        $response = new DealSessionResource($dealSession);

        event(new ForceDeleteEvent($dealSession, $this->all(), $response));

        return $response;

    }
    
}
