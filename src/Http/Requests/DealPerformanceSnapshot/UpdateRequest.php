<?php

namespace Innoboxrr\Deals\Http\Requests\DealPerformanceSnapshot;

use Innoboxrr\Deals\Models\DealPerformanceSnapshot;
use Innoboxrr\Deals\Http\Resources\Models\DealPerformanceSnapshotResource;
use Innoboxrr\Deals\Http\Events\DealPerformanceSnapshot\Events\UpdateEvent;
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
        
        $dealPerformanceSnapshot = DealPerformanceSnapshot::findOrFail($this->deal_performance_snapshot_id);

        return $this->user()->can('update', $dealPerformanceSnapshot);

    }

    public function rules()
    {
        return [
            //
            'deal_performance_snapshot_id' => 'required|numeric'
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

        $dealPerformanceSnapshot = DealPerformanceSnapshot::findOrFail($this->deal_performance_snapshot_id);

        $dealPerformanceSnapshot = $dealPerformanceSnapshot->updateModel($this);

        $response = new DealPerformanceSnapshotResource($dealPerformanceSnapshot);

        event(new UpdateEvent($dealPerformanceSnapshot, $this->all(), $response));

        return $response;

    }

}
