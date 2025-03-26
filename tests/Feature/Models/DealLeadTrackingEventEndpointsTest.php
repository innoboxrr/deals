<?php

namespace Innoboxrr\Deals\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Innoboxrr\Deals\Tests\TestCase;

class DealLeadTrackingEventEndpointsTest extends TestCase
{

    use RefreshDatabase,
        WithFaker;

    public function test_deal_lead_tracking_event_policies_endpoint()
    {

        $dealLeadTrackingEvent = \Innoboxrr\Deals\Models\DealLeadTrackingEvent::factory()->create();
        
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'id' => $dealLeadTrackingEvent->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-lead-tracking-event/policies', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_lead_tracking_event_policy_endpoint()
    {
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'policy' => 'index'
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-lead-tracking-event/policy', $payload, $headers)
            ->assertJsonStructure([
                'index'
            ])
            ->assertStatus(200);

    }

    public function test_deal_lead_tracking_event_index_auth_endpoint()
    {

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-lead-tracking-event/index', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_lead_tracking_event_index_guest_endpoint()
    {

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-lead-tracking-event/index', $payload, $headers)
            ->assertStatus(401);
            
    }
    
    public function test_deal_lead_tracking_event_show_auth_endpoint()
    {

        $dealLeadTrackingEvent = \Innoboxrr\Deals\Models\DealLeadTrackingEvent::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_lead_tracking_event_id' => $dealLeadTrackingEvent->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-lead-tracking-event/show', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_lead_tracking_event_show_guest_endpoint()
    {

        $dealLeadTrackingEvent = \Innoboxrr\Deals\Models\DealLeadTrackingEvent::latest()->first();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_lead_tracking_event_id' => $dealLeadTrackingEvent->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-lead-tracking-event/show', $payload, $headers)
            ->assertStatus(401);
            
    }

    public function test_deal_lead_tracking_event_create_endpoint()
    {

        $user = \Innoboxrr\Deals\Models\User::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = \Innoboxrr\Deals\Models\DealLeadTrackingEvent::factory()->make()->getAttributes();

        $this->json('POST', '/api/innoboxrr/deals/deal-lead-tracking-event/create', $payload, $headers)
            ->assertStatus(201);
            
    }

    public function test_deal_lead_tracking_event_update_endpoint()
    {

        $dealLeadTrackingEvent = \Innoboxrr\Deals\Models\DealLeadTrackingEvent::factory()->create();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            ...\Innoboxrr\Deals\Models\DealLeadTrackingEvent::factory()->make()->getAttributes(),
            'deal_lead_tracking_event_id' => $dealLeadTrackingEvent->id
        ];

        $this->json('PUT', '/api/innoboxrr/deals/deal-lead-tracking-event/update', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_lead_tracking_event_delete_endpoint()
    {

        $dealLeadTrackingEvent = \Innoboxrr\Deals\Models\DealLeadTrackingEvent::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_lead_tracking_event_id' => $dealLeadTrackingEvent->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-lead-tracking-event/delete', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_lead_tracking_event_restore_endpoint()
    {

        $dealLeadTrackingEvent = \Innoboxrr\Deals\Models\DealLeadTrackingEvent::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_lead_tracking_event_id' => $dealLeadTrackingEvent->id
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-lead-tracking-event/restore', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_lead_tracking_event_force_delete_endpoint()
    {

        $dealLeadTrackingEvent = \Innoboxrr\Deals\Models\DealLeadTrackingEvent::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_lead_tracking_event_id' => $dealLeadTrackingEvent->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-lead-tracking-event/force-delete', $payload, $headers)
            ->assertStatus(403);
            
    }

    public function test_deal_lead_tracking_event_export_endpoint()
    {   

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            //
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-lead-tracking-event/export', $payload, $headers)
            ->assertStatus(200);
            
    }

}
