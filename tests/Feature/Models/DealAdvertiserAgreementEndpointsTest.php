<?php

namespace Innoboxrr\Deals\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Innoboxrr\Deals\Tests\TestCase;

class DealAdvertiserAgreementEndpointsTest extends TestCase
{

    use RefreshDatabase,
        WithFaker;

    public function test_deal_advertiser_agreement_policies_endpoint()
    {

        $dealAdvertiserAgreement = \Innoboxrr\Deals\Models\DealAdvertiserAgreement::factory()->create();
        
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'id' => $dealAdvertiserAgreement->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement/policies', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_advertiser_agreement_policy_endpoint()
    {
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'policy' => 'index'
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement/policy', $payload, $headers)
            ->assertJsonStructure([
                'index'
            ])
            ->assertStatus(200);

    }

    public function test_deal_advertiser_agreement_index_auth_endpoint()
    {

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement/index', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_advertiser_agreement_index_guest_endpoint()
    {

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement/index', $payload, $headers)
            ->assertStatus(401);
            
    }
    
    public function test_deal_advertiser_agreement_show_auth_endpoint()
    {

        $dealAdvertiserAgreement = \Innoboxrr\Deals\Models\DealAdvertiserAgreement::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_id' => $dealAdvertiserAgreement->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement/show', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_agreement_show_guest_endpoint()
    {

        $dealAdvertiserAgreement = \Innoboxrr\Deals\Models\DealAdvertiserAgreement::latest()->first();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_id' => $dealAdvertiserAgreement->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement/show', $payload, $headers)
            ->assertStatus(401);
            
    }

    public function test_deal_advertiser_agreement_create_endpoint()
    {

        $user = \Innoboxrr\Deals\Models\User::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = \Innoboxrr\Deals\Models\DealAdvertiserAgreement::factory()->make()->getAttributes();

        $this->json('POST', '/api/innoboxrr/deals/deal-advertiser-agreement/create', $payload, $headers)
            ->assertStatus(201);
            
    }

    public function test_deal_advertiser_agreement_update_endpoint()
    {

        $dealAdvertiserAgreement = \Innoboxrr\Deals\Models\DealAdvertiserAgreement::factory()->create();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            ...\Innoboxrr\Deals\Models\DealAdvertiserAgreement::factory()->make()->getAttributes(),
            'deal_advertiser_agreement_id' => $dealAdvertiserAgreement->id
        ];

        $this->json('PUT', '/api/innoboxrr/deals/deal-advertiser-agreement/update', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_agreement_delete_endpoint()
    {

        $dealAdvertiserAgreement = \Innoboxrr\Deals\Models\DealAdvertiserAgreement::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_id' => $dealAdvertiserAgreement->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-advertiser-agreement/delete', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_agreement_restore_endpoint()
    {

        $dealAdvertiserAgreement = \Innoboxrr\Deals\Models\DealAdvertiserAgreement::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_id' => $dealAdvertiserAgreement->id
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-advertiser-agreement/restore', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_agreement_force_delete_endpoint()
    {

        $dealAdvertiserAgreement = \Innoboxrr\Deals\Models\DealAdvertiserAgreement::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_id' => $dealAdvertiserAgreement->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-advertiser-agreement/force-delete', $payload, $headers)
            ->assertStatus(403);
            
    }

    public function test_deal_advertiser_agreement_export_endpoint()
    {   

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            //
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-advertiser-agreement/export', $payload, $headers)
            ->assertStatus(200);
            
    }

}
