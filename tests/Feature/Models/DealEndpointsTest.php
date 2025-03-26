<?php

namespace Innoboxrr\Deals\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Innoboxrr\Deals\Tests\TestCase;

class DealEndpointsTest extends TestCase
{

    use RefreshDatabase,
        WithFaker;

    public function test_deal_policies_endpoint()
    {

        $deal = \Innoboxrr\Deals\Models\Deal::factory()->create();
        
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'id' => $deal->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal/policies', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_policy_endpoint()
    {
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'policy' => 'index'
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal/policy', $payload, $headers)
            ->assertJsonStructure([
                'index'
            ])
            ->assertStatus(200);

    }

    public function test_deal_index_auth_endpoint()
    {

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal/index', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_index_guest_endpoint()
    {

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal/index', $payload, $headers)
            ->assertStatus(401);
            
    }
    
    public function test_deal_show_auth_endpoint()
    {

        $deal = \Innoboxrr\Deals\Models\Deal::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_id' => $deal->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal/show', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_show_guest_endpoint()
    {

        $deal = \Innoboxrr\Deals\Models\Deal::latest()->first();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_id' => $deal->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal/show', $payload, $headers)
            ->assertStatus(401);
            
    }

    public function test_deal_create_endpoint()
    {

        $user = \Innoboxrr\Deals\Models\User::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = \Innoboxrr\Deals\Models\Deal::factory()->make()->getAttributes();

        $this->json('POST', '/api/innoboxrr/deals/deal/create', $payload, $headers)
            ->assertStatus(201);
            
    }

    public function test_deal_update_endpoint()
    {

        $deal = \Innoboxrr\Deals\Models\Deal::factory()->create();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            ...\Innoboxrr\Deals\Models\Deal::factory()->make()->getAttributes(),
            'deal_id' => $deal->id
        ];

        $this->json('PUT', '/api/innoboxrr/deals/deal/update', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_delete_endpoint()
    {

        $deal = \Innoboxrr\Deals\Models\Deal::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_id' => $deal->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal/delete', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_restore_endpoint()
    {

        $deal = \Innoboxrr\Deals\Models\Deal::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_id' => $deal->id
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal/restore', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_force_delete_endpoint()
    {

        $deal = \Innoboxrr\Deals\Models\Deal::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_id' => $deal->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal/force-delete', $payload, $headers)
            ->assertStatus(403);
            
    }

    public function test_deal_export_endpoint()
    {   

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            //
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal/export', $payload, $headers)
            ->assertStatus(200);
            
    }

}
