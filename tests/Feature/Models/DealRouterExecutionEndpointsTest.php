<?php

namespace Innoboxrr\Deals\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Innoboxrr\Deals\Tests\TestCase;

class DealRouterExecutionEndpointsTest extends TestCase
{

    use RefreshDatabase,
        WithFaker;

    public function test_deal_router_execution_policies_endpoint()
    {

        $dealRouterExecution = \Innoboxrr\Deals\Models\DealRouterExecution::factory()->create();
        
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'id' => $dealRouterExecution->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-router-execution/policies', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_router_execution_policy_endpoint()
    {
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'policy' => 'index'
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-router-execution/policy', $payload, $headers)
            ->assertJsonStructure([
                'index'
            ])
            ->assertStatus(200);

    }

    public function test_deal_router_execution_index_auth_endpoint()
    {

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-router-execution/index', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_router_execution_index_guest_endpoint()
    {

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-router-execution/index', $payload, $headers)
            ->assertStatus(401);
            
    }
    
    public function test_deal_router_execution_show_auth_endpoint()
    {

        $dealRouterExecution = \Innoboxrr\Deals\Models\DealRouterExecution::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_router_execution_id' => $dealRouterExecution->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-router-execution/show', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_router_execution_show_guest_endpoint()
    {

        $dealRouterExecution = \Innoboxrr\Deals\Models\DealRouterExecution::latest()->first();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_router_execution_id' => $dealRouterExecution->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-router-execution/show', $payload, $headers)
            ->assertStatus(401);
            
    }

    public function test_deal_router_execution_create_endpoint()
    {

        $user = \Innoboxrr\Deals\Models\User::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = \Innoboxrr\Deals\Models\DealRouterExecution::factory()->make()->getAttributes();

        $this->json('POST', '/api/innoboxrr/deals/deal-router-execution/create', $payload, $headers)
            ->assertStatus(201);
            
    }

    public function test_deal_router_execution_update_endpoint()
    {

        $dealRouterExecution = \Innoboxrr\Deals\Models\DealRouterExecution::factory()->create();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            ...\Innoboxrr\Deals\Models\DealRouterExecution::factory()->make()->getAttributes(),
            'deal_router_execution_id' => $dealRouterExecution->id
        ];

        $this->json('PUT', '/api/innoboxrr/deals/deal-router-execution/update', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_router_execution_delete_endpoint()
    {

        $dealRouterExecution = \Innoboxrr\Deals\Models\DealRouterExecution::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_router_execution_id' => $dealRouterExecution->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-router-execution/delete', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_router_execution_restore_endpoint()
    {

        $dealRouterExecution = \Innoboxrr\Deals\Models\DealRouterExecution::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_router_execution_id' => $dealRouterExecution->id
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-router-execution/restore', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_router_execution_force_delete_endpoint()
    {

        $dealRouterExecution = \Innoboxrr\Deals\Models\DealRouterExecution::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_router_execution_id' => $dealRouterExecution->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-router-execution/force-delete', $payload, $headers)
            ->assertStatus(403);
            
    }

    public function test_deal_router_execution_export_endpoint()
    {   

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            //
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-router-execution/export', $payload, $headers)
            ->assertStatus(200);
            
    }

}
