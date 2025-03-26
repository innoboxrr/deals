<?php

namespace Innoboxrr\Deals\Http\Requests\DealPerformanceSnapshot;

use Innoboxrr\Deals\Models\DealPerformanceSnapshot;
use Innoboxrr\Deals\Http\Resources\Models\DealPerformanceSnapshotResource;
use Innoboxrr\Deals\Http\Events\DealPerformanceSnapshot\Events\CreateEvent;
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

        return $this->user()->can('create', DealPerformanceSnapshot::class);

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

        $dealPerformanceSnapshot = (new DealPerformanceSnapshot)->createModel($this);

        $response = new DealPerformanceSnapshotResource($dealPerformanceSnapshot);

        event(new CreateEvent($dealPerformanceSnapshot, $this->all(), $response));

        return $response;

    }
    
}
