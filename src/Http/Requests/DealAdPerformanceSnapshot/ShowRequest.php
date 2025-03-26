<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdPerformanceSnapshot;

use Innoboxrr\Deals\Models\DealAdPerformanceSnapshot;
use Innoboxrr\Deals\Http\Resources\Models\DealAdPerformanceSnapshotResource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShowRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {

        $dealAdPerformanceSnapshot = DealAdPerformanceSnapshot::findOrFail($this->deal_ad_performance_snapshot_id);

        return $this->user()->can('view', $dealAdPerformanceSnapshot);

    }

    public function rules()
    {
        return [
            'load_relations' => [
                'nullable',
                'array',
                Rule::in(DealAdPerformanceSnapshot::$loadable_relations)
            ],
            'load_counts' => [
                'nullable',
                'array',
                Rule::in(DealAdPerformanceSnapshot::$loadable_counts)
            ],
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

        $dealAdPerformanceSnapshot = DealAdPerformanceSnapshot::where('id', $this->deal_ad_performance_snapshot_id)
            ->with($this->load_relations ?? [])
            ->withCount($this->load_counts ?? [])
            ->firstOrFail();

        return new DealAdPerformanceSnapshotResource($dealAdPerformanceSnapshot);

    }
    
}
