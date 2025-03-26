<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdCampaign;

use Innoboxrr\Deals\Models\DealAdCampaign;
use Innoboxrr\Deals\Http\Resources\Models\DealAdCampaignResource;
use Innoboxrr\Deals\Http\Events\DealAdCampaign\Events\ForceDeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class ForceDeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {

        $dealAdCampaign = DealAdCampaign::withTrashed()->findOrFail($this->deal_ad_campaign_id);
        
        return $this->user()->can('forceDelete', $dealAdCampaign);

    }

    public function rules()
    {
        return [
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

        $dealAdCampaign = DealAdCampaign::withTrashed()->findOrFail($this->deal_ad_campaign_id);

        $dealAdCampaign->forceDeleteModel();

        $response = new DealAdCampaignResource($dealAdCampaign);

        event(new ForceDeleteEvent($dealAdCampaign, $this->all(), $response));

        return $response;

    }
    
}
