<?php

namespace Innoboxrr\Deals\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Innoboxrr\Deals\Tests\TestCase;

class DealAlertEndpointsTest extends TestCase
{

    use RefreshDatabase,
        WithFaker;

    public function test_deal_alert_policies_endpoint()
    {

        $dealAlert = \Innoboxrr\Deals\Models\DealAlert::factory()->create();
        
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'id' => $dealAlert->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-alert/policies', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_alert_policy_endpoint()
    {
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'policy' => 'index'
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-alert/policy', $payload, $headers)
            ->assertJsonStructure([
                'index'
            ])
            ->assertStatus(200);

    }

    public function test_deal_alert_index_auth_endpoint()
    {

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-alert/index', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_alert_index_guest_endpoint()
    {

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-alert/index', $payload, $headers)
            ->assertStatus(401);
            
    }
    
    public function test_deal_alert_show_auth_endpoint()
    {

        $dealAlert = \Innoboxrr\Deals\Models\DealAlert::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_alert_id' => $dealAlert->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-alert/show', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_alert_show_guest_endpoint()
    {

        $dealAlert = \Innoboxrr\Deals\Models\DealAlert::latest()->first();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_alert_id' => $dealAlert->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-alert/show', $payload, $headers)
            ->assertStatus(401);
            
    }

    public function test_deal_alert_create_endpoint()
    {

        $user = \Innoboxrr\Deals\Models\User::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = \Innoboxrr\Deals\Models\DealAlert::factory()->make()->getAttributes();

        $this->json('POST', '/api/innoboxrr/deals/deal-alert/create', $payload, $headers)
            ->assertStatus(201);
            
    }

    public function test_deal_alert_update_endpoint()
    {

        $dealAlert = \Innoboxrr\Deals\Models\DealAlert::factory()->create();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            ...\Innoboxrr\Deals\Models\DealAlert::factory()->make()->getAttributes(),
            'deal_alert_id' => $dealAlert->id
        ];

        $this->json('PUT', '/api/innoboxrr/deals/deal-alert/update', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_alert_delete_endpoint()
    {

        $dealAlert = \Innoboxrr\Deals\Models\DealAlert::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_alert_id' => $dealAlert->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-alert/delete', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_alert_restore_endpoint()
    {

        $dealAlert = \Innoboxrr\Deals\Models\DealAlert::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_alert_id' => $dealAlert->id
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-alert/restore', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_alert_force_delete_endpoint()
    {

        $dealAlert = \Innoboxrr\Deals\Models\DealAlert::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_alert_id' => $dealAlert->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-alert/force-delete', $payload, $headers)
            ->assertStatus(403);
            
    }

    public function test_deal_alert_export_endpoint()
    {   

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            //
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-alert/export', $payload, $headers)
            ->assertStatus(200);
            
    }

}
