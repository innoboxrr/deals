<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdPlatform;

use Innoboxrr\Deals\Models\DealAdPlatform;
use Innoboxrr\Deals\Http\Resources\Models\DealAdPlatformResource;
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

        $dealAdPlatform = DealAdPlatform::findOrFail($this->deal_ad_platform_id);

        return $this->user()->can('view', $dealAdPlatform);

    }

    public function rules()
    {
        return [
            'load_relations' => [
                'nullable',
                'array',
                Rule::in(DealAdPlatform::$loadable_relations)
            ],
            'load_counts' => [
                'nullable',
                'array',
                Rule::in(DealAdPlatform::$loadable_counts)
            ],
            'deal_ad_platform_id' => 'required|numeric'
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

        $dealAdPlatform = DealAdPlatform::where('id', $this->deal_ad_platform_id)
            ->with($this->load_relations ?? [])
            ->withCount($this->load_counts ?? [])
            ->firstOrFail();

        return new DealAdPlatformResource($dealAdPlatform);

    }
    
}
