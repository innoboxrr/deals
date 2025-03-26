<?php

namespace Innoboxrr\Deals\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Innoboxrr\Deals\Tests\TestCase;

class DealAdvertiserAgreementDailyEndpointsTest extends TestCase
{

    use RefreshDatabase,
        WithFaker;

    public function test_deal_advertiser_agreement_daily_policies_endpoint()
    {

        $dealAdvertiserAgreementDaily = \Innoboxrr\Deals\Models\DealAdvertiserAgreementDaily::factory()->create();
        
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'id' => $dealAdvertiserAgreementDaily->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-daily/policies', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_advertiser_agreement_daily_policy_endpoint()
    {
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'policy' => 'index'
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-daily/policy', $payload, $headers)
            ->assertJsonStructure([
                'index'
            ])
            ->assertStatus(200);

    }

    public function test_deal_advertiser_agreement_daily_index_auth_endpoint()
    {

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-daily/index', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_advertiser_agreement_daily_index_guest_endpoint()
    {

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-daily/index', $payload, $headers)
            ->assertStatus(401);
            
    }
    
    public function test_deal_advertiser_agreement_daily_show_auth_endpoint()
    {

        $dealAdvertiserAgreementDaily = \Innoboxrr\Deals\Models\DealAdvertiserAgreementDaily::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_daily_id' => $dealAdvertiserAgreementDaily->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-daily/show', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_agreement_daily_show_guest_endpoint()
    {

        $dealAdvertiserAgreementDaily = \Innoboxrr\Deals\Models\DealAdvertiserAgreementDaily::latest()->first();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_daily_id' => $dealAdvertiserAgreementDaily->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser-agreement-daily/show', $payload, $headers)
            ->assertStatus(401);
            
    }

    public function test_deal_advertiser_agreement_daily_create_endpoint()
    {

        $user = \Innoboxrr\Deals\Models\User::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = \Innoboxrr\Deals\Models\DealAdvertiserAgreementDaily::factory()->make()->getAttributes();

        $this->json('POST', '/api/innoboxrr/deals/deal-advertiser-agreement-daily/create', $payload, $headers)
            ->assertStatus(201);
            
    }

    public function test_deal_advertiser_agreement_daily_update_endpoint()
    {

        $dealAdvertiserAgreementDaily = \Innoboxrr\Deals\Models\DealAdvertiserAgreementDaily::factory()->create();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            ...\Innoboxrr\Deals\Models\DealAdvertiserAgreementDaily::factory()->make()->getAttributes(),
            'deal_advertiser_agreement_daily_id' => $dealAdvertiserAgreementDaily->id
        ];

        $this->json('PUT', '/api/innoboxrr/deals/deal-advertiser-agreement-daily/update', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_agreement_daily_delete_endpoint()
    {

        $dealAdvertiserAgreementDaily = \Innoboxrr\Deals\Models\DealAdvertiserAgreementDaily::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_daily_id' => $dealAdvertiserAgreementDaily->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-advertiser-agreement-daily/delete', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_agreement_daily_restore_endpoint()
    {

        $dealAdvertiserAgreementDaily = \Innoboxrr\Deals\Models\DealAdvertiserAgreementDaily::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_daily_id' => $dealAdvertiserAgreementDaily->id
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-advertiser-agreement-daily/restore', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_agreement_daily_force_delete_endpoint()
    {

        $dealAdvertiserAgreementDaily = \Innoboxrr\Deals\Models\DealAdvertiserAgreementDaily::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_agreement_daily_id' => $dealAdvertiserAgreementDaily->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-advertiser-agreement-daily/force-delete', $payload, $headers)
            ->assertStatus(403);
            
    }

    public function test_deal_advertiser_agreement_daily_export_endpoint()
    {   

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            //
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-advertiser-agreement-daily/export', $payload, $headers)
            ->assertStatus(200);
            
    }

}
