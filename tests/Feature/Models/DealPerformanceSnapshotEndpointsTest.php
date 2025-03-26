<?php

namespace Innoboxrr\Deals\Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Innoboxrr\Deals\Tests\TestCase;

class DealPerformanceSnapshotEndpointsTest extends TestCase
{

    use RefreshDatabase,
        WithFaker;

    public function test_deal_performance_snapshot_policies_endpoint()
    {

        $dealPerformanceSnapshot = \Innoboxrr\Deals\Models\DealPerformanceSnapshot::factory()->create();
        
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'id' => $dealPerformanceSnapshot->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-performance-snapshot/policies', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_performance_snapshot_policy_endpoint()
    {
        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'policy' => 'index'
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-performance-snapshot/policy', $payload, $headers)
            ->assertJsonStructure([
                'index'
            ])
            ->assertStatus(200);

    }

    public function test_deal_performance_snapshot_index_auth_endpoint()
    {

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-performance-snapshot/index', $payload, $headers)
            ->assertStatus(200);

    }

    public function test_deal_performance_snapshot_index_guest_endpoint()
    {

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'managed' => true
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-performance-snapshot/index', $payload, $headers)
            ->assertStatus(401);
            
    }
    
    public function test_deal_performance_snapshot_show_auth_endpoint()
    {

        $dealPerformanceSnapshot = \Innoboxrr\Deals\Models\DealPerformanceSnapshot::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_performance_snapshot_id' => $dealPerformanceSnapshot->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-performance-snapshot/show', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_performance_snapshot_show_guest_endpoint()
    {

        $dealPerformanceSnapshot = \Innoboxrr\Deals\Models\DealPerformanceSnapshot::latest()->first();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_performance_snapshot_id' => $dealPerformanceSnapshot->id
        ];

        $this->json('GET', '/api/innoboxrr/deals/deal-performance-snapshot/show', $payload, $headers)
            ->assertStatus(401);
            
    }

    public function test_deal_performance_snapshot_create_endpoint()
    {

        $user = \Innoboxrr\Deals\Models\User::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = \Innoboxrr\Deals\Models\DealPerformanceSnapshot::factory()->make()->getAttributes();

        $this->json('POST', '/api/innoboxrr/deals/deal-performance-snapshot/create', $payload, $headers)
            ->assertStatus(201);
            
    }

    public function test_deal_performance_snapshot_update_endpoint()
    {

        $dealPerformanceSnapshot = \Innoboxrr\Deals\Models\DealPerformanceSnapshot::factory()->create();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            ...\Innoboxrr\Deals\Models\DealPerformanceSnapshot::factory()->make()->getAttributes(),
            'deal_performance_snapshot_id' => $dealPerformanceSnapshot->id
        ];

        $this->json('PUT', '/api/innoboxrr/deals/deal-performance-snapshot/update', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_performance_snapshot_delete_endpoint()
    {

        $dealPerformanceSnapshot = \Innoboxrr\Deals\Models\DealPerformanceSnapshot::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_performance_snapshot_id' => $dealPerformanceSnapshot->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-performance-snapshot/delete', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_performance_snapshot_restore_endpoint()
    {

        $dealPerformanceSnapshot = \Innoboxrr\Deals\Models\DealPerformanceSnapshot::first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_performance_snapshot_id' => $dealPerformanceSnapshot->id
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-performance-snapshot/restore', $payload, $headers)
            ->assertStatus(200);
            
    }

    public function test_deal_performance_snapshot_force_delete_endpoint()
    {

        $dealPerformanceSnapshot = \Innoboxrr\Deals\Models\DealPerformanceSnapshot::latest()->first();

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            'deal_performance_snapshot_id' => $dealPerformanceSnapshot->id
        ];

        $this->json('DELETE', '/api/innoboxrr/deals/deal-performance-snapshot/force-delete', $payload, $headers)
            ->assertStatus(403);
            
    }

    public function test_deal_performance_snapshot_export_endpoint()
    {   

        $headers = [
            'Authorization' => config('test.token'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];  

        $payload = [
            //
        ];

        $this->json('POST', '/api/innoboxrr/deals/deal-performance-snapshot/export', $payload, $headers)
            ->assertStatus(200);
            
    }

}
