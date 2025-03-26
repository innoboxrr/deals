<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdPerformanceSnapshot;

use Innoboxrr\Deals\Models\DealAdPerformanceSnapshot;
use Innoboxrr\Deals\Http\Resources\Models\DealAdPerformanceSnapshotResource;
use Innoboxrr\Deals\Http\Events\DealAdPerformanceSnapshot\Events\ForceDeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class ForceDeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {

        $dealAdPerformanceSnapshot = DealAdPerformanceSnapshot::withTrashed()->findOrFail($this->deal_ad_performance_snapshot_id);
        
        return $this->user()->can('forceDelete', $dealAdPerformanceSnapshot);

    }

    public function rules()
    {
        return [
            'deal_ad_performance_snapshot_id' => 'required|numeric'
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

        $dealAdPerformanceSnapshot = DealAdPerformanceSnapshot::withTrashed()->findOrFail($this->deal_ad_performance_snapshot_id);

        $dealAdPerformanceSnapshot->forceDeleteModel();

        $response = new DealAdPerformanceSnapshotResource($dealAdPerformanceSnapshot);

        event(new ForceDeleteEvent($dealAdPerformanceSnapshot, $this->all(), $response));

        return $response;

    }
    
}
