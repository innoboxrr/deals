<?php

namespace Innoboxrr\Deals\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Innoboxrr\Deals\Tests\TestCase;

class DealAdCampaignEndpointsTest extends TestCase
{

    use RefreshDatabase,
        WithFaker;

    public function test_deal_ad_campaign_policies_endpoint()
    {

        $dealAdCampaign = \Innoboxrr\Deals\Models\DealAdCampaign::factory()->create();
        
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'id' => $dealAdCampaign->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-ad-campaign/policies', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_ad_campaign_policy_endpoint()
    {
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'policy' => 'index'
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-ad-campaign/policy', $payload, $headers)
            ->assertJsonStructure([
                'index'
            ])
            ->assertStatus(200);

    }

    public function test_deal_ad_campaign_index_auth_endpoint()
    {

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-ad-campaign/index', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_ad_campaign_index_guest_endpoint()
    {

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-ad-campaign/index', $payload, $headers)
            ->assertStatus(401);
            
    }
    
    public function test_deal_ad_campaign_show_auth_endpoint()
    {

        $dealAdCampaign = \Innoboxrr\Deals\Models\DealAdCampaign::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_ad_campaign_id' => $dealAdCampaign->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-ad-campaign/show', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_ad_campaign_show_guest_endpoint()
    {

        $dealAdCampaign = \Innoboxrr\Deals\Models\DealAdCampaign::latest()->first();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_ad_campaign_id' => $dealAdCampaign->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-ad-campaign/show', $payload, $headers)
            ->assertStatus(401);
            
    }

    public function test_deal_ad_campaign_create_endpoint()
    {

        $user = \Innoboxrr\Deals\Models\User::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = \Innoboxrr\Deals\Models\DealAdCampaign::factory()->make()->getAttributes();

        $this->json('POST', '/api/innoboxrr/deals/deal-ad-campaign/create', $payload, $headers)
            ->assertStatus(201);
            
    }

    public function test_deal_ad_campaign_update_endpoint()
    {

        $dealAdCampaign = \Innoboxrr\Deals\Models\DealAdCampaign::factory()->create();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            ...\Innoboxrr\Deals\Models\DealAdCampaign::factory()->make()->getAttributes(),
            'deal_ad_campaign_id' => $dealAdCampaign->id
        ];

        $this->json('PUT', '/api/innoboxrr/deals/deal-ad-campaign/update', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_ad_campaign_delete_endpoint()
    {

        $dealAdCampaign = \Innoboxrr\Deals\Models\DealAdCampaign::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_ad_campaign_id' => $dealAdCampaign->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-ad-campaign/delete', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_ad_campaign_restore_endpoint()
    {

        $dealAdCampaign = \Innoboxrr\Deals\Models\DealAdCampaign::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_ad_campaign_id' => $dealAdCampaign->id
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-ad-campaign/restore', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_ad_campaign_force_delete_endpoint()
    {

        $dealAdCampaign = \Innoboxrr\Deals\Models\DealAdCampaign::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_ad_campaign_id' => $dealAdCampaign->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-ad-campaign/force-delete', $payload, $headers)
            ->assertStatus(403);
            
    }

    public function test_deal_ad_campaign_export_endpoint()
    {   

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            //
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-ad-campaign/export', $payload, $headers)
            ->assertStatus(200);
            
    }

}
