<?php

namespace Innoboxrr\Deals\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Innoboxrr\Deals\Tests\TestCase;

class DealAdvertiserAgreementIntegrationEndpointsTest extends TestCase
{

    use RefreshDatabase,
        WithFaker;

    public function test_deal_advertiser_agreement_integration_policies_endpoint()
    {

        $dealAdvertiserAgreementIntegration = \Innoboxrr\Deals\Models\DealAdvertiserAgreementIntegration::factory()->create();
        
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'id' => $dealAdvertiserAgreementIntegration->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-integration/policies', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_advertiser_agreement_integration_policy_endpoint()
    {
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'policy' => 'index'
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-integration/policy', $payload, $headers)
            ->assertJsonStructure([
                'index'
            ])
            ->assertStatus(200);

    }

    public function test_deal_advertiser_agreement_integration_index_auth_endpoint()
    {

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-integration/index', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_advertiser_agreement_integration_index_guest_endpoint()
    {

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-integration/index', $payload, $headers)
            ->assertStatus(401);
            
    }
    
    public function test_deal_advertiser_agreement_integration_show_auth_endpoint()
    {

        $dealAdvertiserAgreementIntegration = \Innoboxrr\Deals\Models\DealAdvertiserAgreementIntegration::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_integration_id' => $dealAdvertiserAgreementIntegration->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-integration/show', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_agreement_integration_show_guest_endpoint()
    {

        $dealAdvertiserAgreementIntegration = \Innoboxrr\Deals\Models\DealAdvertiserAgreementIntegration::latest()->first();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_integration_id' => $dealAdvertiserAgreementIntegration->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-integration/show', $payload, $headers)
            ->assertStatus(401);
            
    }

    public function test_deal_advertiser_agreement_integration_create_endpoint()
    {

        $user = \Innoboxrr\Deals\Models\User::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = \Innoboxrr\Deals\Models\DealAdvertiserAgreementIntegration::factory()->make()->getAttributes();

        $this->json('POST', '/api/innoboxrr/deals/deal-advertiser-agreement-integration/create', $payload, $headers)
            ->assertStatus(201);
            
    }

    public function test_deal_advertiser_agreement_integration_update_endpoint()
    {

        $dealAdvertiserAgreementIntegration = \Innoboxrr\Deals\Models\DealAdvertiserAgreementIntegration::factory()->create();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            ...\Innoboxrr\Deals\Models\DealAdvertiserAgreementIntegration::factory()->make()->getAttributes(),
            'deal_advertiser_agreement_integration_id' => $dealAdvertiserAgreementIntegration->id
        ];

        $this->json('PUT', '/api/innoboxrr/deals/deal-advertiser-agreement-integration/update', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_agreement_integration_delete_endpoint()
    {

        $dealAdvertiserAgreementIntegration = \Innoboxrr\Deals\Models\DealAdvertiserAgreementIntegration::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_integration_id' => $dealAdvertiserAgreementIntegration->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-advertiser-agreement-integration/delete', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_agreement_integration_restore_endpoint()
    {

        $dealAdvertiserAgreementIntegration = \Innoboxrr\Deals\Models\DealAdvertiserAgreementIntegration::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_integration_id' => $dealAdvertiserAgreementIntegration->id
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-advertiser-agreement-integration/restore', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_agreement_integration_force_delete_endpoint()
    {

        $dealAdvertiserAgreementIntegration = \Innoboxrr\Deals\Models\DealAdvertiserAgreementIntegration::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_integration_id' => $dealAdvertiserAgreementIntegration->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-advertiser-agreement-integration/force-delete', $payload, $headers)
            ->assertStatus(403);
            
    }

    public function test_deal_advertiser_agreement_integration_export_endpoint()
    {   

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            //
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-advertiser-agreement-integration/export', $payload, $headers)
            ->assertStatus(200);
            
    }

}
