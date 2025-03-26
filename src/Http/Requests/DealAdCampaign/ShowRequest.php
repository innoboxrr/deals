<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdCampaign;

use Innoboxrr\Deals\Models\DealAdCampaign;
use Innoboxrr\Deals\Http\Resources\Models\DealAdCampaignResource;
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

        $dealAdCampaign = DealAdCampaign::findOrFail($this->deal_ad_campaign_id);

        return $this->user()->can('view', $dealAdCampaign);

    }

    public function rules()
    {
        return [
            'load_relations' => [
                'nullable',
                'array',
                Rule::in(DealAdCampaign::$loadable_relations)
            ],
            'load_counts' => [
                'nullable',
                'array',
                Rule::in(DealAdCampaign::$loadable_counts)
            ],
            'deal_ad_campaign_id' => 'required|numeric'
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

        $dealAdCampaign = DealAdCampaign::where('id', $this->deal_ad_campaign_id)
            ->with($this->load_relations ?? [])
            ->withCount($this->load_counts ?? [])
            ->firstOrFail();

        return new DealAdCampaignResource($dealAdCampaign);

    }
    
}
