<?php

namespace Innoboxrr\Deals\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Innoboxrr\Deals\Tests\TestCase;

class DealAdvertiserAgreementPostbackEndpointsTest extends TestCase
{

    use RefreshDatabase,
        WithFaker;

    public function test_deal_advertiser_agreement_postback_policies_endpoint()
    {

        $dealAdvertiserAgreementPostback = \Innoboxrr\Deals\Models\DealAdvertiserAgreementPostback::factory()->create();
        
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'id' => $dealAdvertiserAgreementPostback->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-postback/policies', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_advertiser_agreement_postback_policy_endpoint()
    {
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'policy' => 'index'
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-postback/policy', $payload, $headers)
            ->assertJsonStructure([
                'index'
            ])
            ->assertStatus(200);

    }

    public function test_deal_advertiser_agreement_postback_index_auth_endpoint()
    {

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-postback/index', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_advertiser_agreement_postback_index_guest_endpoint()
    {

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-postback/index', $payload, $headers)
            ->assertStatus(401);
            
    }
    
    public function test_deal_advertiser_agreement_postback_show_auth_endpoint()
    {

        $dealAdvertiserAgreementPostback = \Innoboxrr\Deals\Models\DealAdvertiserAgreementPostback::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_postback_id' => $dealAdvertiserAgreementPostback->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-postback/show', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_agreement_postback_show_guest_endpoint()
    {

        $dealAdvertiserAgreementPostback = \Innoboxrr\Deals\Models\DealAdvertiserAgreementPostback::latest()->first();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_postback_id' => $dealAdvertiserAgreementPostback->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-postback/show', $payload, $headers)
            ->assertStatus(401);
            
    }

    public function test_deal_advertiser_agreement_postback_create_endpoint()
    {

        $user = \Innoboxrr\Deals\Models\User::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = \Innoboxrr\Deals\Models\DealAdvertiserAgreementPostback::factory()->make()->getAttributes();

        $this->json('POST', '/api/innoboxrr/deals/deal-advertiser-agreement-postback/create', $payload, $headers)
            ->assertStatus(201);
            
    }

    public function test_deal_advertiser_agreement_postback_update_endpoint()
    {

        $dealAdvertiserAgreementPostback = \Innoboxrr\Deals\Models\DealAdvertiserAgreementPostback::factory()->create();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            ...\Innoboxrr\Deals\Models\DealAdvertiserAgreementPostback::factory()->make()->getAttributes(),
            'deal_advertiser_agreement_postback_id' => $dealAdvertiserAgreementPostback->id
        ];

        $this->json('PUT', '/api/innoboxrr/deals/deal-advertiser-agreement-postback/update', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_agreement_postback_delete_endpoint()
    {

        $dealAdvertiserAgreementPostback = \Innoboxrr\Deals\Models\DealAdvertiserAgreementPostback::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_postback_id' => $dealAdvertiserAgreementPostback->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-advertiser-agreement-postback/delete', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_agreement_postback_restore_endpoint()
    {

        $dealAdvertiserAgreementPostback = \Innoboxrr\Deals\Models\DealAdvertiserAgreementPostback::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_postback_id' => $dealAdvertiserAgreementPostback->id
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-advertiser-agreement-postback/restore', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_agreement_postback_force_delete_endpoint()
    {

        $dealAdvertiserAgreementPostback = \Innoboxrr\Deals\Models\DealAdvertiserAgreementPostback::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_postback_id' => $dealAdvertiserAgreementPostback->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-advertiser-agreement-postback/force-delete', $payload, $headers)
            ->assertStatus(403);
            
    }

    public function test_deal_advertiser_agreement_postback_export_endpoint()
    {   

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            //
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-advertiser-agreement-postback/export', $payload, $headers)
            ->assertStatus(200);
            
    }

}
