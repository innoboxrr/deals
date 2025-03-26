<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdCampaign;

use Innoboxrr\Deals\Models\DealAdCampaign;
use Innoboxrr\Deals\Http\Resources\Models\DealAdCampaignResource;
use Innoboxrr\Deals\Http\Events\DealAdCampaign\Events\UpdateEvent;
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
        
        $dealAdCampaign = DealAdCampaign::findOrFail($this->deal_ad_campaign_id);

        return $this->user()->can('update', $dealAdCampaign);

    }

    public function rules()
    {
        return [
            //
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

        $dealAdCampaign = DealAdCampaign::findOrFail($this->deal_ad_campaign_id);

        $dealAdCampaign = $dealAdCampaign->updateModel($this);

        $response = new DealAdCampaignResource($dealAdCampaign);

        event(new UpdateEvent($dealAdCampaign, $this->all(), $response));

        return $response;

    }

}
