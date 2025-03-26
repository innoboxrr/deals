<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdCampaign;

use Innoboxrr\Deals\Models\DealAdCampaign;
use Innoboxrr\Deals\Http\Resources\Models\DealAdCampaignResource;
use Innoboxrr\Deals\Http\Events\DealAdCampaign\Events\DeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $dealAdCampaign = DealAdCampaign::findOrFail($this->deal_ad_campaign_id);

        return $this->user()->can('delete', $dealAdCampaign);

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

        $dealAdCampaign = DealAdCampaign::findOrFail($this->deal_ad_campaign_id);

        $dealAdCampaign->deleteModel();

        $response = new DealAdCampaignResource($dealAdCampaign);

        event(new DeleteEvent($dealAdCampaign, $this->all(), $response));

        return $response;

    }
    
}
