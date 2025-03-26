<?php

namespace Innoboxrr\Deals\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Innoboxrr\Deals\Tests\TestCase;

class DealAssignmentEndpointsTest extends TestCase
{

    use RefreshDatabase,
        WithFaker;

    public function test_deal_assignment_policies_endpoint()
    {

        $dealAssignment = \Innoboxrr\Deals\Models\DealAssignment::factory()->create();
        
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'id' => $dealAssignment->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-assignment/policies', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_assignment_policy_endpoint()
    {
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'policy' => 'index'
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-assignment/policy', $payload, $headers)
            ->assertJsonStructure([
                'index'
            ])
            ->assertStatus(200);

    }

    public function test_deal_assignment_index_auth_endpoint()
    {

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-assignment/index', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_assignment_index_guest_endpoint()
    {

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-assignment/index', $payload, $headers)
            ->assertStatus(401);
            
    }
    
    public function test_deal_assignment_show_auth_endpoint()
    {

        $dealAssignment = \Innoboxrr\Deals\Models\DealAssignment::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_assignment_id' => $dealAssignment->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-assignment/show', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_assignment_show_guest_endpoint()
    {

        $dealAssignment = \Innoboxrr\Deals\Models\DealAssignment::latest()->first();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_assignment_id' => $dealAssignment->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-assignment/show', $payload, $headers)
            ->assertStatus(401);
            
    }

    public function test_deal_assignment_create_endpoint()
    {

        $user = \Innoboxrr\Deals\Models\User::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = \Innoboxrr\Deals\Models\DealAssignment::factory()->make()->getAttributes();

        $this->json('POST', '/api/innoboxrr/deals/deal-assignment/create', $payload, $headers)
            ->assertStatus(201);
            
    }

    public function test_deal_assignment_update_endpoint()
    {

        $dealAssignment = \Innoboxrr\Deals\Models\DealAssignment::factory()->create();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            ...\Innoboxrr\Deals\Models\DealAssignment::factory()->make()->getAttributes(),
            'deal_assignment_id' => $dealAssignment->id
        ];

        $this->json('PUT', '/api/innoboxrr/deals/deal-assignment/update', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_assignment_delete_endpoint()
    {

        $dealAssignment = \Innoboxrr\Deals\Models\DealAssignment::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_assignment_id' => $dealAssignment->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-assignment/delete', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_assignment_restore_endpoint()
    {

        $dealAssignment = \Innoboxrr\Deals\Models\DealAssignment::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_assignment_id' => $dealAssignment->id
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-assignment/restore', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_assignment_force_delete_endpoint()
    {

        $dealAssignment = \Innoboxrr\Deals\Models\DealAssignment::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_assignment_id' => $dealAssignment->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-assignment/force-delete', $payload, $headers)
            ->assertStatus(403);
            
    }

    public function test_deal_assignment_export_endpoint()
    {   

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            //
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-assignment/export', $payload, $headers)
            ->assertStatus(200);
            
    }

}
