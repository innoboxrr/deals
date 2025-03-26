<?php

namespace Innoboxrr\Deals\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Innoboxrr\Deals\Tests\TestCase;

class DealAdvertiserEndpointsTest extends TestCase
{

    use RefreshDatabase,
        WithFaker;

    public function test_deal_advertiser_policies_endpoint()
    {

        $dealAdvertiser = \Innoboxrr\Deals\Models\DealAdvertiser::factory()->create();
        
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'id' => $dealAdvertiser->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser/policies', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_advertiser_policy_endpoint()
    {
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'policy' => 'index'
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser/policy', $payload, $headers)
            ->assertJsonStructure([
                'index'
            ])
            ->assertStatus(200);

    }

    public function test_deal_advertiser_index_auth_endpoint()
    {

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser/index', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_advertiser_index_guest_endpoint()
    {

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser/index', $payload, $headers)
            ->assertStatus(401);
            
    }
    
    public function test_deal_advertiser_show_auth_endpoint()
    {

        $dealAdvertiser = \Innoboxrr\Deals\Models\DealAdvertiser::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_id' => $dealAdvertiser->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser/show', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_show_guest_endpoint()
    {

        $dealAdvertiser = \Innoboxrr\Deals\Models\DealAdvertiser::latest()->first();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_id' => $dealAdvertiser->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-advertiser/show', $payload, $headers)
            ->assertStatus(401);
            
    }

    public function test_deal_advertiser_create_endpoint()
    {

        $user = \Innoboxrr\Deals\Models\User::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = \Innoboxrr\Deals\Models\DealAdvertiser::factory()->make()->getAttributes();

        $this->json('POST', '/api/innoboxrr/deals/deal-advertiser/create', $payload, $headers)
            ->assertStatus(201);
            
    }

    public function test_deal_advertiser_update_endpoint()
    {

        $dealAdvertiser = \Innoboxrr\Deals\Models\DealAdvertiser::factory()->create();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            ...\Innoboxrr\Deals\Models\DealAdvertiser::factory()->make()->getAttributes(),
            'deal_advertiser_id' => $dealAdvertiser->id
        ];

        $this->json('PUT', '/api/innoboxrr/deals/deal-advertiser/update', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_delete_endpoint()
    {

        $dealAdvertiser = \Innoboxrr\Deals\Models\DealAdvertiser::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_id' => $dealAdvertiser->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-advertiser/delete', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_restore_endpoint()
    {

        $dealAdvertiser = \Innoboxrr\Deals\Models\DealAdvertiser::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_id' => $dealAdvertiser->id
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-advertiser/restore', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_advertiser_force_delete_endpoint()
    {

        $dealAdvertiser = \Innoboxrr\Deals\Models\DealAdvertiser::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_advertiser_id' => $dealAdvertiser->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-advertiser/force-delete', $payload, $headers)
            ->assertStatus(403);
            
    }

    public function test_deal_advertiser_export_endpoint()
    {   

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            //
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-advertiser/export', $payload, $headers)
            ->assertStatus(200);
            
    }

}
