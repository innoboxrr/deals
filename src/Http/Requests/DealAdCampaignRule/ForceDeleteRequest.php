<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdCampaignRule;

use Innoboxrr\Deals\Models\DealAdCampaignRule;
use Innoboxrr\Deals\Http\Resources\Models\DealAdCampaignRuleResource;
use Innoboxrr\Deals\Http\Events\DealAdCampaignRule\Events\ForceDeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class ForceDeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {

        $dealAdCampaignRule = DealAdCampaignRule::withTrashed()->findOrFail($this->deal_ad_campaign_rule_id);
        
        return $this->user()->can('forceDelete', $dealAdCampaignRule);

    }

    public function rules()
    {
        return [
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

        $dealAdCampaignRule = DealAdCampaignRule::withTrashed()->findOrFail($this->deal_ad_campaign_rule_id);

        $dealAdCampaignRule->forceDeleteModel();

        $response = new DealAdCampaignRuleResource($dealAdCampaignRule);

        event(new ForceDeleteEvent($dealAdCampaignRule, $this->all(), $response));

        return $response;

    }
    
}
