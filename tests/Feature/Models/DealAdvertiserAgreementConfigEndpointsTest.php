<?php

namespace Innoboxrr\Deals\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Innoboxrr\Deals\Tests\TestCase;

class DealAdvertiserAgreementConfigEndpointsTest extends TestCase
{

    use RefreshDatabase,
        WithFaker;

    public function test_deal_advertiser_agreement_config_policies_endpoint()
    {

        $dealAdvertiserAgreementConfig = \Innoboxrr\Deals\Models\DealAdvertiserAgreementConfig::factory()->create();
        
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'id' => $dealAdvertiserAgreementConfig->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-config/policies', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_advertiser_agreement_config_policy_endpoint()
    {
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'policy' => 'index'
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-config/policy', $payload, $headers)
            ->assertJsonStructure([
                'index'
            ])
            ->assertStatus(200);

    }

    public function test_deal_advertiser_agreement_config_index_auth_endpoint()
    {

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-config/index', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_advertiser_agreement_config_index_guest_endpoint()
    {

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-config/index', $payload, $headers)
            ->assertStatus(401);
            
    }
    
    public function test_deal_advertiser_agreement_config_show_auth_endpoint()
    {

        $dealAdvertiserAgreementConfig = \Innoboxrr\Deals\Models\DealAdvertiserAgreementConfig::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_config_id' => $dealAdvertiserAgreementConfig->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-config/show', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_agreement_config_show_guest_endpoint()
    {

        $dealAdvertiserAgreementConfig = \Innoboxrr\Deals\Models\DealAdvertiserAgreementConfig::latest()->first();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_config_id' => $dealAdvertiserAgreementConfig->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-config/show', $payload, $headers)
            ->assertStatus(401);
            
    }

    public function test_deal_advertiser_agreement_config_create_endpoint()
    {

        $user = \Innoboxrr\Deals\Models\User::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = \Innoboxrr\Deals\Models\DealAdvertiserAgreementConfig::factory()->make()->getAttributes();

        $this->json('POST', '/api/innoboxrr/deals/deal-advertiser-agreement-config/create', $payload, $headers)
            ->assertStatus(201);
            
    }

    public function test_deal_advertiser_agreement_config_update_endpoint()
    {

        $dealAdvertiserAgreementConfig = \Innoboxrr\Deals\Models\DealAdvertiserAgreementConfig::factory()->create();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            ...\Innoboxrr\Deals\Models\DealAdvertiserAgreementConfig::factory()->make()->getAttributes(),
            'deal_advertiser_agreement_config_id' => $dealAdvertiserAgreementConfig->id
        ];

        $this->json('PUT', '/api/innoboxrr/deals/deal-advertiser-agreement-config/update', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_agreement_config_delete_endpoint()
    {

        $dealAdvertiserAgreementConfig = \Innoboxrr\Deals\Models\DealAdvertiserAgreementConfig::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_config_id' => $dealAdvertiserAgreementConfig->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-advertiser-agreement-config/delete', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_agreement_config_restore_endpoint()
    {

        $dealAdvertiserAgreementConfig = \Innoboxrr\Deals\Models\DealAdvertiserAgreementConfig::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_config_id' => $dealAdvertiserAgreementConfig->id
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-advertiser-agreement-config/restore', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_agreement_config_force_delete_endpoint()
    {

        $dealAdvertiserAgreementConfig = \Innoboxrr\Deals\Models\DealAdvertiserAgreementConfig::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_config_id' => $dealAdvertiserAgreementConfig->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-advertiser-agreement-config/force-delete', $payload, $headers)
            ->assertStatus(403);
            
    }

    public function test_deal_advertiser_agreement_config_export_endpoint()
    {   

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            //
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-advertiser-agreement-config/export', $payload, $headers)
            ->assertStatus(200);
            
    }

}
