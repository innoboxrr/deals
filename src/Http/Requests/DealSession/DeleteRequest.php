<?php

namespace Innoboxrr\Deals\Http\Requests\DealSession;

use Innoboxrr\Deals\Models\DealSession;
use Innoboxrr\Deals\Http\Resources\Models\DealSessionResource;
use Innoboxrr\Deals\Http\Events\DealSession\Events\DeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $dealSession = DealSession::findOrFail($this->deal_session_id);

        return $this->user()->can('delete', $dealSession);

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

        $dealSession = DealSession::findOrFail($this->deal_session_id);

        $dealSession->deleteModel();

        $response = new DealSessionResource($dealSession);

        event(new DeleteEvent($dealSession, $this->all(), $response));

        return $response;

    }
    
}
