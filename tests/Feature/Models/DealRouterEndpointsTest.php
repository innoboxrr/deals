<?php

namespace Innoboxrr\Deals\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Innoboxrr\Deals\Tests\TestCase;

class DealRouterEndpointsTest extends TestCase
{

    use RefreshDatabase,
        WithFaker;

    public function test_deal_router_policies_endpoint()
    {

        $dealRouter = \Innoboxrr\Deals\Models\DealRouter::factory()->create();
        
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'id' => $dealRouter->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-router/policies', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_router_policy_endpoint()
    {
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'policy' => 'index'
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-router/policy', $payload, $headers)
            ->assertJsonStructure([
                'index'
            ])
            ->assertStatus(200);

    }

    public function test_deal_router_index_auth_endpoint()
    {

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-router/index', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_router_index_guest_endpoint()
    {

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-router/index', $payload, $headers)
            ->assertStatus(401);
            
    }
    
    public function test_deal_router_show_auth_endpoint()
    {

        $dealRouter = \Innoboxrr\Deals\Models\DealRouter::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_router_id' => $dealRouter->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-router/show', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_router_show_guest_endpoint()
    {

        $dealRouter = \Innoboxrr\Deals\Models\DealRouter::latest()->first();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_router_id' => $dealRouter->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-router/show', $payload, $headers)
            ->assertStatus(401);
            
    }

    public function test_deal_router_create_endpoint()
    {

        $user = \Innoboxrr\Deals\Models\User::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = \Innoboxrr\Deals\Models\DealRouter::factory()->make()->getAttributes();

        $this->json('POST', '/api/innoboxrr/deals/deal-router/create', $payload, $headers)
            ->assertStatus(201);
            
    }

    public function test_deal_router_update_endpoint()
    {

        $dealRouter = \Innoboxrr\Deals\Models\DealRouter::factory()->create();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            ...\Innoboxrr\Deals\Models\DealRouter::factory()->make()->getAttributes(),
            'deal_router_id' => $dealRouter->id
        ];

        $this->json('PUT', '/api/innoboxrr/deals/deal-router/update', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_router_delete_endpoint()
    {

        $dealRouter = \Innoboxrr\Deals\Models\DealRouter::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_router_id' => $dealRouter->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-router/delete', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_router_restore_endpoint()
    {

        $dealRouter = \Innoboxrr\Deals\Models\DealRouter::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_router_id' => $dealRouter->id
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-router/restore', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_router_force_delete_endpoint()
    {

        $dealRouter = \Innoboxrr\Deals\Models\DealRouter::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_router_id' => $dealRouter->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-router/force-delete', $payload, $headers)
            ->assertStatus(403);
            
    }

    public function test_deal_router_export_endpoint()
    {   

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            //
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-router/export', $payload, $headers)
            ->assertStatus(200);
            
    }

}
