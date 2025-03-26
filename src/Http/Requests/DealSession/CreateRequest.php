<?php

namespace Innoboxrr\Deals\Http\Requests\DealSession;

use Innoboxrr\Deals\Models\DealSession;
use Innoboxrr\Deals\Http\Resources\Models\DealSessionResource;
use Innoboxrr\Deals\Http\Events\DealSession\Events\CreateEvent;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {

        return $this->user()->can('create', DealSession::class);

    }

    public function rules()
    {
        return [
            //
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

        $dealSession = (new DealSession)->createModel($this);

        $response = new DealSessionResource($dealSession);

        event(new CreateEvent($dealSession, $this->all(), $response));

        return $response;

    }
    
}
