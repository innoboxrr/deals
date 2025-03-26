<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdCampaignRule;

use Innoboxrr\Deals\Models\DealAdCampaignRule;
use Innoboxrr\Deals\Http\Resources\Models\DealAdCampaignRuleResource;
use Innoboxrr\Deals\Http\Events\DealAdCampaignRule\Events\UpdateEvent;
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
        
        $dealAdCampaignRule = DealAdCampaignRule::findOrFail($this->deal_ad_campaign_rule_id);

        return $this->user()->can('update', $dealAdCampaignRule);

    }

    public function rules()
    {
        return [
            //
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

        $dealAdCampaignRule = DealAdCampaignRule::findOrFail($this->deal_ad_campaign_rule_id);

        $dealAdCampaignRule = $dealAdCampaignRule->updateModel($this);

        $response = new DealAdCampaignRuleResource($dealAdCampaignRule);

        event(new UpdateEvent($dealAdCampaignRule, $this->all(), $response));

        return $response;

    }

}
