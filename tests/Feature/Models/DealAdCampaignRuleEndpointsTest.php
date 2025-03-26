<?php

namespace Innoboxrr\Deals\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Innoboxrr\Deals\Tests\TestCase;

class DealAdCampaignRuleEndpointsTest extends TestCase
{

    use RefreshDatabase,
        WithFaker;

    public function test_deal_ad_campaign_rule_policies_endpoint()
    {

        $dealAdCampaignRule = \Innoboxrr\Deals\Models\DealAdCampaignRule::factory()->create();
        
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'id' => $dealAdCampaignRule->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-ad-campaign-rule/policies', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_ad_campaign_rule_policy_endpoint()
    {
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'policy' => 'index'
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-ad-campaign-rule/policy', $payload, $headers)
            ->assertJsonStructure([
                'index'
            ])
            ->assertStatus(200);

    }

    public function test_deal_ad_campaign_rule_index_auth_endpoint()
    {

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-ad-campaign-rule/index', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_ad_campaign_rule_index_guest_endpoint()
    {

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-ad-campaign-rule/index', $payload, $headers)
            ->assertStatus(401);
            
    }
    
    public function test_deal_ad_campaign_rule_show_auth_endpoint()
    {

        $dealAdCampaignRule = \Innoboxrr\Deals\Models\DealAdCampaignRule::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_ad_campaign_rule_id' => $dealAdCampaignRule->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-ad-campaign-rule/show', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_ad_campaign_rule_show_guest_endpoint()
    {

        $dealAdCampaignRule = \Innoboxrr\Deals\Models\DealAdCampaignRule::latest()->first();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_ad_campaign_rule_id' => $dealAdCampaignRule->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-ad-campaign-rule/show', $payload, $headers)
            ->assertStatus(401);
            
    }

    public function test_deal_ad_campaign_rule_create_endpoint()
    {

        $user = \Innoboxrr\Deals\Models\User::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = \Innoboxrr\Deals\Models\DealAdCampaignRule::factory()->make()->getAttributes();

        $this->json('POST', '/api/innoboxrr/deals/deal-ad-campaign-rule/create', $payload, $headers)
            ->assertStatus(201);
            
    }

    public function test_deal_ad_campaign_rule_update_endpoint()
    {

        $dealAdCampaignRule = \Innoboxrr\Deals\Models\DealAdCampaignRule::factory()->create();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            ...\Innoboxrr\Deals\Models\DealAdCampaignRule::factory()->make()->getAttributes(),
            'deal_ad_campaign_rule_id' => $dealAdCampaignRule->id
        ];

        $this->json('PUT', '/api/innoboxrr/deals/deal-ad-campaign-rule/update', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_ad_campaign_rule_delete_endpoint()
    {

        $dealAdCampaignRule = \Innoboxrr\Deals\Models\DealAdCampaignRule::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_ad_campaign_rule_id' => $dealAdCampaignRule->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-ad-campaign-rule/delete', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_ad_campaign_rule_restore_endpoint()
    {

        $dealAdCampaignRule = \Innoboxrr\Deals\Models\DealAdCampaignRule::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_ad_campaign_rule_id' => $dealAdCampaignRule->id
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-ad-campaign-rule/restore', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_ad_campaign_rule_force_delete_endpoint()
    {

        $dealAdCampaignRule = \Innoboxrr\Deals\Models\DealAdCampaignRule::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_ad_campaign_rule_id' => $dealAdCampaignRule->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-ad-campaign-rule/force-delete', $payload, $headers)
            ->assertStatus(403);
            
    }

    public function test_deal_ad_campaign_rule_export_endpoint()
    {   

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            //
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-ad-campaign-rule/export', $payload, $headers)
            ->assertStatus(200);
            
    }

}
