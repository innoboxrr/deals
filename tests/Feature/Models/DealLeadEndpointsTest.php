<?php

namespace Innoboxrr\Deals\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Innoboxrr\Deals\Tests\TestCase;

class DealLeadEndpointsTest extends TestCase
{

    use RefreshDatabase,
        WithFaker;

    public function test_deal_lead_policies_endpoint()
    {

        $dealLead = \Innoboxrr\Deals\Models\DealLead::factory()->create();
        
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'id' => $dealLead->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-lead/policies', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_lead_policy_endpoint()
    {
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'policy' => 'index'
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-lead/policy', $payload, $headers)
            ->assertJsonStructure([
                'index'
            ])
            ->assertStatus(200);

    }

    public function test_deal_lead_index_auth_endpoint()
    {

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-lead/index', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_lead_index_guest_endpoint()
    {

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-lead/index', $payload, $headers)
            ->assertStatus(401);
            
    }
    
    public function test_deal_lead_show_auth_endpoint()
    {

        $dealLead = \Innoboxrr\Deals\Models\DealLead::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_lead_id' => $dealLead->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-lead/show', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_lead_show_guest_endpoint()
    {

        $dealLead = \Innoboxrr\Deals\Models\DealLead::latest()->first();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_lead_id' => $dealLead->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-lead/show', $payload, $headers)
            ->assertStatus(401);
            
    }

    public function test_deal_lead_create_endpoint()
    {

        $user = \Innoboxrr\Deals\Models\User::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = \Innoboxrr\Deals\Models\DealLead::factory()->make()->getAttributes();

        $this->json('POST', '/api/innoboxrr/deals/deal-lead/create', $payload, $headers)
            ->assertStatus(201);
            
    }

    public function test_deal_lead_update_endpoint()
    {

        $dealLead = \Innoboxrr\Deals\Models\DealLead::factory()->create();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            ...\Innoboxrr\Deals\Models\DealLead::factory()->make()->getAttributes(),
            'deal_lead_id' => $dealLead->id
        ];

        $this->json('PUT', '/api/innoboxrr/deals/deal-lead/update', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_lead_delete_endpoint()
    {

        $dealLead = \Innoboxrr\Deals\Models\DealLead::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_lead_id' => $dealLead->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-lead/delete', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_lead_restore_endpoint()
    {

        $dealLead = \Innoboxrr\Deals\Models\DealLead::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_lead_id' => $dealLead->id
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-lead/restore', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_lead_force_delete_endpoint()
    {

        $dealLead = \Innoboxrr\Deals\Models\DealLead::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_lead_id' => $dealLead->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-lead/force-delete', $payload, $headers)
            ->assertStatus(403);
            
    }

    public function test_deal_lead_export_endpoint()
    {   

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            //
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-lead/export', $payload, $headers)
            ->assertStatus(200);
            
    }

}
