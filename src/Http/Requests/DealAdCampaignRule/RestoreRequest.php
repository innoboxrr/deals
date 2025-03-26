<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdCampaignRule;

use Innoboxrr\Deals\Models\DealAdCampaignRule;
use Innoboxrr\Deals\Http\Resources\Models\DealAdCampaignRuleResource;
use Innoboxrr\Deals\Http\Events\DealAdCampaignRule\Events\RestoreEvent;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RestoreRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $dealAdCampaignRule = DealAdCampaignRule::withTrashed()->findOrFail($this->deal_ad_campaign_rule_id);
        
        return $this->user()->can('restore', $dealAdCampaignRule);

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

        $dealAdCampaignRule->restoreModel();

        $response = new DealAdCampaignRuleResource($dealAdCampaignRule);

        event(new RestoreEvent($dealAdCampaignRule, $this->all(), $response));

        return $response;

    }
    
}
