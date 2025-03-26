<?php

namespace Innoboxrr\Deals\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Innoboxrr\Deals\Tests\TestCase;

class DealGatewayEndpointsTest extends TestCase
{

    use RefreshDatabase,
        WithFaker;

    public function test_deal_gateway_policies_endpoint()
    {

        $dealGateway = \Innoboxrr\Deals\Models\DealGateway::factory()->create();
        
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'id' => $dealGateway->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-gateway/policies', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_gateway_policy_endpoint()
    {
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'policy' => 'index'
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-gateway/policy', $payload, $headers)
            ->assertJsonStructure([
                'index'
            ])
            ->assertStatus(200);

    }

    public function test_deal_gateway_index_auth_endpoint()
    {

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-gateway/index', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_gateway_index_guest_endpoint()
    {

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-gateway/index', $payload, $headers)
            ->assertStatus(401);
            
    }
    
    public function test_deal_gateway_show_auth_endpoint()
    {

        $dealGateway = \Innoboxrr\Deals\Models\DealGateway::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_gateway_id' => $dealGateway->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-gateway/show', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_gateway_show_guest_endpoint()
    {

        $dealGateway = \Innoboxrr\Deals\Models\DealGateway::latest()->first();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_gateway_id' => $dealGateway->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-gateway/show', $payload, $headers)
            ->assertStatus(401);
            
    }

    public function test_deal_gateway_create_endpoint()
    {

        $user = \Innoboxrr\Deals\Models\User::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = \Innoboxrr\Deals\Models\DealGateway::factory()->make()->getAttributes();

        $this->json('POST', '/api/innoboxrr/deals/deal-gateway/create', $payload, $headers)
            ->assertStatus(201);
            
    }

    public function test_deal_gateway_update_endpoint()
    {

        $dealGateway = \Innoboxrr\Deals\Models\DealGateway::factory()->create();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            ...\Innoboxrr\Deals\Models\DealGateway::factory()->make()->getAttributes(),
            'deal_gateway_id' => $dealGateway->id
        ];

        $this->json('PUT', '/api/innoboxrr/deals/deal-gateway/update', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_gateway_delete_endpoint()
    {

        $dealGateway = \Innoboxrr\Deals\Models\DealGateway::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_gateway_id' => $dealGateway->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-gateway/delete', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_gateway_restore_endpoint()
    {

        $dealGateway = \Innoboxrr\Deals\Models\DealGateway::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_gateway_id' => $dealGateway->id
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-gateway/restore', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_gateway_force_delete_endpoint()
    {

        $dealGateway = \Innoboxrr\Deals\Models\DealGateway::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_gateway_id' => $dealGateway->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-gateway/force-delete', $payload, $headers)
            ->assertStatus(403);
            
    }

    public function test_deal_gateway_export_endpoint()
    {   

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            //
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-gateway/export', $payload, $headers)
            ->assertStatus(200);
            
    }

}
