<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdCampaignRule;

use Innoboxrr\Deals\Models\DealAdCampaignRule;
use Innoboxrr\Deals\Http\Resources\Models\DealAdCampaignRuleResource;
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

        $dealAdCampaignRule = DealAdCampaignRule::findOrFail($this->deal_ad_campaign_rule_id);

        return $this->user()->can('view', $dealAdCampaignRule);

    }

    public function rules()
    {
        return [
            'load_relations' => [
                'nullable',
                'array',
                Rule::in(DealAdCampaignRule::$loadable_relations)
            ],
            'load_counts' => [
                'nullable',
                'array',
                Rule::in(DealAdCampaignRule::$loadable_counts)
            ],
            'deal_ad_campaign_rule_id' => 'required|numeric'
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

        $dealAdCampaignRule = DealAdCampaignRule::where('id', $this->deal_ad_campaign_rule_id)
            ->with($this->load_relations ?? [])
            ->withCount($this->load_counts ?? [])
            ->firstOrFail();

        return new DealAdCampaignRuleResource($dealAdCampaignRule);

    }
    
}
