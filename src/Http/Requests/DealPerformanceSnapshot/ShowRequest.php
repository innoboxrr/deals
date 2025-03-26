<?php

namespace Innoboxrr\Deals\Http\Requests\DealPerformanceSnapshot;

use Innoboxrr\Deals\Models\DealPerformanceSnapshot;
use Innoboxrr\Deals\Http\Resources\Models\DealPerformanceSnapshotResource;
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

        $dealPerformanceSnapshot = DealPerformanceSnapshot::findOrFail($this->deal_performance_snapshot_id);

        return $this->user()->can('view', $dealPerformanceSnapshot);

    }

    public function rules()
    {
        return [
            'load_relations' => [
                'nullable',
                'array',
                Rule::in(DealPerformanceSnapshot::$loadable_relations)
            ],
            'load_counts' => [
                'nullable',
                'array',
                Rule::in(DealPerformanceSnapshot::$loadable_counts)
            ],
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

        $dealPerformanceSnapshot = DealPerformanceSnapshot::where('id', $this->deal_performance_snapshot_id)
            ->with($this->load_relations ?? [])
            ->withCount($this->load_counts ?? [])
            ->firstOrFail();

        return new DealPerformanceSnapshotResource($dealPerformanceSnapshot);

    }
    
}
