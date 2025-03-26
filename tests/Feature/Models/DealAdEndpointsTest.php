<?php

namespace Innoboxrr\Deals\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Innoboxrr\Deals\Tests\TestCase;

class DealAdEndpointsTest extends TestCase
{

    use RefreshDatabase,
        WithFaker;

    public function test_deal_ad_policies_endpoint()
    {

        $dealAd = \Innoboxrr\Deals\Models\DealAd::factory()->create();
        
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'id' => $dealAd->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-ad/policies', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_ad_policy_endpoint()
    {
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'policy' => 'index'
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-ad/policy', $payload, $headers)
            ->assertJsonStructure([
                'index'
            ])
            ->assertStatus(200);

    }

    public function test_deal_ad_index_auth_endpoint()
    {

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-ad/index', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_ad_index_guest_endpoint()
    {

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-ad/index', $payload, $headers)
            ->assertStatus(401);
            
    }
    
    public function test_deal_ad_show_auth_endpoint()
    {

        $dealAd = \Innoboxrr\Deals\Models\DealAd::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_ad_id' => $dealAd->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-ad/show', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_ad_show_guest_endpoint()
    {

        $dealAd = \Innoboxrr\Deals\Models\DealAd::latest()->first();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_ad_id' => $dealAd->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-ad/show', $payload, $headers)
            ->assertStatus(401);
            
    }

    public function test_deal_ad_create_endpoint()
    {

        $user = \Innoboxrr\Deals\Models\User::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = \Innoboxrr\Deals\Models\DealAd::factory()->make()->getAttributes();

        $this->json('POST', '/api/innoboxrr/deals/deal-ad/create', $payload, $headers)
            ->assertStatus(201);
            
    }

    public function test_deal_ad_update_endpoint()
    {

        $dealAd = \Innoboxrr\Deals\Models\DealAd::factory()->create();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            ...\Innoboxrr\Deals\Models\DealAd::factory()->make()->getAttributes(),
            'deal_ad_id' => $dealAd->id
        ];

        $this->json('PUT', '/api/innoboxrr/deals/deal-ad/update', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_ad_delete_endpoint()
    {

        $dealAd = \Innoboxrr\Deals\Models\DealAd::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_ad_id' => $dealAd->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-ad/delete', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_ad_restore_endpoint()
    {

        $dealAd = \Innoboxrr\Deals\Models\DealAd::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_ad_id' => $dealAd->id
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-ad/restore', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_ad_force_delete_endpoint()
    {

        $dealAd = \Innoboxrr\Deals\Models\DealAd::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_ad_id' => $dealAd->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-ad/force-delete', $payload, $headers)
            ->assertStatus(403);
            
    }

    public function test_deal_ad_export_endpoint()
    {   

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            //
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-ad/export', $payload, $headers)
            ->assertStatus(200);
            
    }

}
