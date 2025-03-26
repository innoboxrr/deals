<?php

namespace Innoboxrr\Deals\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Innoboxrr\Deals\Tests\TestCase;

class DealSessionEndpointsTest extends TestCase
{

    use RefreshDatabase,
        WithFaker;

    public function test_deal_session_policies_endpoint()
    {

        $dealSession = \Innoboxrr\Deals\Models\DealSession::factory()->create();
        
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'id' => $dealSession->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-session/policies', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_session_policy_endpoint()
    {
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'policy' => 'index'
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-session/policy', $payload, $headers)
            ->assertJsonStructure([
                'index'
            ])
            ->assertStatus(200);

    }

    public function test_deal_session_index_auth_endpoint()
    {

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-session/index', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_session_index_guest_endpoint()
    {

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-session/index', $payload, $headers)
            ->assertStatus(401);
            
    }
    
    public function test_deal_session_show_auth_endpoint()
    {

        $dealSession = \Innoboxrr\Deals\Models\DealSession::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_session_id' => $dealSession->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-session/show', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_session_show_guest_endpoint()
    {

        $dealSession = \Innoboxrr\Deals\Models\DealSession::latest()->first();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_session_id' => $dealSession->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-session/show', $payload, $headers)
            ->assertStatus(401);
            
    }

    public function test_deal_session_create_endpoint()
    {

        $user = \Innoboxrr\Deals\Models\User::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = \Innoboxrr\Deals\Models\DealSession::factory()->make()->getAttributes();

        $this->json('POST', '/api/innoboxrr/deals/deal-session/create', $payload, $headers)
            ->assertStatus(201);
            
    }

    public function test_deal_session_update_endpoint()
    {

        $dealSession = \Innoboxrr\Deals\Models\DealSession::factory()->create();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            ...\Innoboxrr\Deals\Models\DealSession::factory()->make()->getAttributes(),
            'deal_session_id' => $dealSession->id
        ];

        $this->json('PUT', '/api/innoboxrr/deals/deal-session/update', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_session_delete_endpoint()
    {

        $dealSession = \Innoboxrr\Deals\Models\DealSession::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_session_id' => $dealSession->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-session/delete', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_session_restore_endpoint()
    {

        $dealSession = \Innoboxrr\Deals\Models\DealSession::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_session_id' => $dealSession->id
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-session/restore', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_session_force_delete_endpoint()
    {

        $dealSession = \Innoboxrr\Deals\Models\DealSession::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_session_id' => $dealSession->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-session/force-delete', $payload, $headers)
            ->assertStatus(403);
            
    }

    public function test_deal_session_export_endpoint()
    {   

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            //
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-session/export', $payload, $headers)
            ->assertStatus(200);
            
    }

}
