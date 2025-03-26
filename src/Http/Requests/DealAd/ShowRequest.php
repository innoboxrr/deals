<?php

namespace Innoboxrr\Deals\Http\Requests\DealAd;

use Innoboxrr\Deals\Models\DealAd;
use Innoboxrr\Deals\Http\Resources\Models\DealAdResource;
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

        $dealAd = DealAd::findOrFail($this->deal_ad_id);

        return $this->user()->can('view', $dealAd);

    }

    public function rules()
    {
        return [
            'load_relations' => [
                'nullable',
                'array',
                Rule::in(DealAd::$loadable_relations)
            ],
            'load_counts' => [
                'nullable',
                'array',
                Rule::in(DealAd::$loadable_counts)
            ],
            'deal_ad_id' => 'required|numeric'
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

        $dealAd = DealAd::where('id', $this->deal_ad_id)
            ->with($this->load_relations ?? [])
            ->withCount($this->load_counts ?? [])
            ->firstOrFail();

        return new DealAdResource($dealAd);

    }
    
}
